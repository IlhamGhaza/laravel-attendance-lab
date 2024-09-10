<?php

namespace App\Filament\Resources\SubjectResource\Pages;

use App\Filament\Resources\SubjectResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;use Filament\Notifications\Notification;


class CreateSubject extends CreateRecord
{
    protected static string $resource = SubjectResource::class;
    public function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
    //success notify
    protected function getSavedNotification(): ?Notification
    {
        return Notification::make()
            ->success()
            ->title('Subject Created')
            ->body('The subject has been created successfully.');
    }
}
