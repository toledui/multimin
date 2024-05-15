<?php

namespace App\Filament\Resources\DistribuitorResource\Pages;

use App\Filament\Resources\DistribuitorResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditDistribuitor extends EditRecord
{
    protected static string $resource = DistribuitorResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
