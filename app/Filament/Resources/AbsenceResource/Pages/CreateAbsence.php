<?php

namespace App\Filament\Resources\AbsenceResource\Pages;

use App\Filament\Resources\AbsenceResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Filament\Notifications\Notification;


class CreateAbsence extends CreateRecord
{
    protected static string $resource = AbsenceResource::class;
    public function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
    //notification succes
    protected function getCreatedNotification(): ?Notification
    {
        return Notification::make()
            ->title('Absence created')
            ->body('Absence has been created successfully.')
            ->success();
    }
}
