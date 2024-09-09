<?php

namespace App\Filament\Resources\LabResource\Pages;

use App\Filament\Resources\LabResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewLab extends ViewRecord
{
    protected static string $resource = LabResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
