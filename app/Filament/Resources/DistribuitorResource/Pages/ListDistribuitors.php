<?php

namespace App\Filament\Resources\DistribuitorResource\Pages;

use App\Filament\Resources\DistribuitorResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListDistribuitors extends ListRecords
{
    protected static string $resource = DistribuitorResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
