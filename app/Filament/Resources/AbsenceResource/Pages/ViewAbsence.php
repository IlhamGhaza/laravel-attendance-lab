<?php

namespace App\Filament\Resources\AbsenceResource\Pages;

use App\Filament\Resources\AbsenceResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewAbsence extends ViewRecord
{
    protected static string $resource = AbsenceResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
