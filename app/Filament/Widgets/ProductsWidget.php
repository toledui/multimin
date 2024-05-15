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


class ProductsWidget extends BaseWidget
{
    protected static ?int $sort = 3;
    
    protected function getStats(): array
    {

        $results = DB::table('tickets')
    ->select(
        'distribuitors.id as distribuitor_id',
        'distribuitors.name as distribuitor_name',
        'products.id as product_id',
        'products.name as product_name',
        DB::raw('SUM(tickets.total_amount) as total_sales')
    )
    ->join('distribuitors', 'tickets.distribuitor_id', '=', 'distribuitors.id')
    ->join('products', 'tickets.product_id', '=', 'products.id')
    ->groupBy('distribuitors.id', 'distribuitors.name', 'products.id', 'products.name')
    ->orderBy('products.id')
    ->orderByDesc('total_sales')
    ->get();

    $topSellers = collect($results)->groupBy('product_id')->map(function ($group) {
        return $group->sortByDesc('total_sales')->first();
    });
    $seller1 = $topSellers[1];
    $seller2 = $topSellers[2];
        
        // dd($topSellers[1]);
            return [
                Stat::make($seller1->product_name, $seller1->total_sales)
                ->description($seller1->distribuitor_name)
                ->descriptionIcon('heroicon-m-ticket', IconPosition::Before)
                ->color("success"),            
                Stat::make($seller2->product_name, $seller2->total_sales)
                ->description($seller2->distribuitor_name)
                ->descriptionIcon('heroicon-m-ticket', IconPosition::Before)
                ->color("success"),            
            ];
        
    }
}