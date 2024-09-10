<?php

namespace App\Filament\Resources\AbsenceResource\Pages;

use App\Filament\Resources\AbsenceResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Filament\Notifications\Notification;


class EditAbsence extends EditRecord
{
    protected static string $resource = AbsenceResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
            Actions\ForceDeleteAction::make(),
            Actions\RestoreAction::make(),
        ];
    }
    public function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
    //edit success notify
    protected function getSavedNotification(): ?Notification
    {
        return Notification::make()
            ->success()
            ->title('Absence Edited')
            ->body('Absence has been edited!');
    }
    //delete success notify
    protected function getDeletedNotification(): ?Notification
    {
        return Notification::make()
            ->success()
            ->title('Absence Deleted')
            ->body('Absence has been deleted!');
    }
    //restore success notify
    protected function getRestoredNotification(): ?Notification
    {
        return Notification::make()
            ->success()
            ->title('Absence Restored')
            ->body('Absence has been restored!');
    }
    //force delete success notify
    protected function getForceDeletedNotification(): ?Notification
    {
        return Notification::make()
            ->success()
            ->title('Absence Force Deleted')
            ->body('Absence has been force deleted!');
    }
}
