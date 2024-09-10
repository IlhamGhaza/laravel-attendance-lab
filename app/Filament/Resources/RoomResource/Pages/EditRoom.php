<?php

namespace App\Filament\Resources\RoomResource\Pages;

use App\Filament\Resources\RoomResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Filament\Notifications\Notification;

class EditRoom extends EditRecord
{
    protected static string $resource = RoomResource::class;

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
            ->title('Room updated.')
            ->body('The room has been updated successfully.');
    }
    //delete success notify
    protected function getDeletedNotification(): ?Notification
    {
        return Notification::make()
            ->success()
            ->title('Room Deleted')
            ->body('Room has been deleted!');
    }
    //force delete success notify
    protected function getForceDeletedNotification(): ?Notification
    {
        return Notification::make()
            ->success()
            ->title('Room Force Deleted')
            ->body('Room has been force deleted!');
    }
    //restore success notify
    protected function getRestoredNotification(): ?Notification
    {
        return Notification::make()
            ->success()
            ->title('Room Restored')
            ->body('Room has been restored!');
    }
}
