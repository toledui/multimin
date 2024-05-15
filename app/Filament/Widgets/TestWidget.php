<?php

namespace App\Filament\Widgets;

use App\Models\User;
use App\Models\Ticket;
use App\Models\Distribuitor;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Filament\Support\Enums\IconPosition;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;


class TestWidget extends BaseWidget
{
    
    protected function getStats(): array
    {
        // Conteo de tickets
        if(Auth::user()->hasRole('Administrador')){
            $ticketsPerDay = Ticket::select(DB::raw('DATE(created_at) as date'), DB::raw('count(*) as count'))
            ->groupBy('date')
            ->get()
            ->toArray();
        }else{
           
            $ticketsPerDay = Ticket::select(DB::raw('DATE(created_at) as date'), DB::raw('count(*) as count'))
            ->where('user_id', Auth::user()->id)
            ->groupBy('date')
            ->get()
            ->toArray();
        }

        $labelsTickets = array_column($ticketsPerDay, 'date');
        $valuesTickets = array_column($ticketsPerDay, 'count');

        // Conteo de usuarios
        $usersPerDay = User::select(DB::raw('DATE(created_at) as date'), DB::raw('count(*) as count'))
        ->groupBy('date')
        ->get()
        ->toArray();
        $labelsUsers = array_column($usersPerDay, 'date');
        $valuesUsers = array_column($usersPerDay, 'count');

        if(Auth::user()->hasRole('Administrador')){
            // //get the distribuitor with more sales
            $sumPerDistribuitor = Ticket::select('distribuitor_id', DB::raw('SUM(total_amount) as total_sales'))
            ->groupBy('distribuitor_id')
            ->get(); 
            $topDistribuitor = $sumPerDistribuitor->sortByDesc('total_sales')->first();
            $topDistribuitorDetails = Distribuitor::find($topDistribuitor->distribuitor_id);
            $totalTickets = Ticket::count();
            $totalUsuarios = User::count();
        }else{
            
            $distribuitorId = Auth::user()->distribuitor_id;
            // //get the distribuitor with more sales
            $sumPerDistribuitor = Ticket::select('distribuitor_id', DB::raw('SUM(total_amount) as total_sales'))
            ->where('distribuitor_id', $distribuitorId)
            ->groupBy('distribuitor_id')
            ->get(); 
            $topDistribuitor = $sumPerDistribuitor->first();
            $topDistribuitorDetails = Distribuitor::find($topDistribuitor->distribuitor_id);
            $totalTickets = Ticket::where('user_id', Auth::user()->id)->count();
            $totalUsuarios = User::where('distribuitor_id', Auth::user()->distribuitor_id)->count();
        }

        // Get the sales per day
        $salesPerDay = Ticket::select(DB::raw('DATE(created_at) as date'), DB::raw('SUM(total_amount) as total_sales'))
        ->where('distribuitor_id', $topDistribuitor->distribuitor_id)
        ->groupBy('date')
        ->get()
        ->toArray();


        $distribuitorName = "Nombre del distribuidor";

        if(Auth::user()->hasRole('Administrador')){
            $distribuitorName = "Distribuidor C/Más Ventas";
        }

        // Prepare the data for the chart
        $labelsTotalSales = array_column($salesPerDay, 'date');
        $valuesTotalSales = array_column($salesPerDay, 'total_sales');

        return [
            Stat::make('Usuarios Registrados', $totalUsuarios)
            ->description('Nuevos usuarios que se han unido')
            ->descriptionIcon('heroicon-m-ticket', IconPosition::Before)
            ->chart($valuesUsers)
            ->color("success"),
            Stat::make('Tickets Registrados', $totalTickets)
            ->description('Tickets Registrados')
            ->descriptionIcon('heroicon-m-users', IconPosition::Before)
            ->chart($valuesTickets)
            ->color("success"),
            Stat::make($distribuitorName, $topDistribuitor->total_sales)
            ->description($topDistribuitorDetails->name ?? 'No disponible')
            ->descriptionIcon('heroicon-m-presentation-chart-line', IconPosition::Before)
            ->chart($valuesTotalSales)
            ->color("success"),
        ];
    }
}
