<?php

namespace App\Filament\Resources\NoteResource\Pages;

use App\Filament\Resources\NoteResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Filament\Notifications\Notification;


class EditNote extends EditRecord
{
    protected static string $resource = NoteResource::class;

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
            ->title('Note updated.')
            ->body('The note has been updated successfully.');
    }
    //edit failed notify
    protected function getFailedNotification(): ?Notification
    {
        return Notification::make()
            ->danger()
            ->title('Note update failed.')
            ->body('The note could not be updated. Please try again.');
    }
    //delete success notify
    protected function getDeletedNotification(): ?Notification
    {
        return Notification::make()
            ->success()
            ->title('Note deleted.')
            ->body('The note has been deleted successfully.');
    }
    //restore success notify
    protected function getRestoredNotification(): ?Notification
    {
        return Notification::make()
            ->success()
            ->title('Note restored.')
            ->body('The note has been restored successfully.');
    }
    //force delete success notify
    protected function getForceDeletedNotification(): ?Notification
    {
        return Notification::make()
            ->success()
            ->title('Note force deleted.')
            ->body('The note has been force deleted successfully.');
    }
}
