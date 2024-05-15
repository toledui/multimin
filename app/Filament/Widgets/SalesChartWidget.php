<?php

namespace App\Filament\Widgets;

use App\Models\Ticket;
use Filament\Widgets\ChartWidget;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class SalesChartWidget extends ChartWidget
{
    protected static ?string $heading = 'Grafica de Total Diario';
    protected static ?int $sort = 3;

    protected function getData(): array
    {
        if(Auth::user()->hasRole('Administrador')){
            $salesData = Ticket::select(DB::raw('DATE(created_at) as date'), DB::raw('SUM(total_amount) as total_sales'))
            ->groupBy('date')
            ->orderBy('date', 'asc')
            ->get();
        }else{
            $salesData = Ticket::select(DB::raw('DATE(created_at) as date'), DB::raw('SUM(total_amount) as total_sales'))
            ->where('distribuitor_id', Auth::user()->distribuitor_id)
            ->groupBy('date')
            ->orderBy('date', 'asc')
            ->get();
        }

        // Preparar los arreglos de etiquetas y valores
        $labelsSales = $salesData->pluck('date')->all();
        $valuesSales = $salesData->pluck('total_sales')->all();
       
        return [
            'datasets' => [
                [
                    'label' => 'Ventas por día',
                    'data' => $valuesSales,
                ],
            ],
            'labels' => $labelsSales,
        ];
    }

    protected function getType(): string
    {
        return 'line';
    }
}
