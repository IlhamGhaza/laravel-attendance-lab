<?php

namespace App\Filament\Resources\AttendanceResource\Pages;

use App\Filament\Resources\AttendanceResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Filament\Notifications\Notification;


class EditAttendance extends EditRecord
{
    protected static string $resource = AttendanceResource::class;

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
            ->title('Attendance Updated')
            ->body('The attendance has been updated successfully.');
    }
    //delete success notify
    protected function getDeletedNotification(): ?Notification
    {
        return Notification::make()
            ->success()
            ->title('Attendance Deleted')
            ->body('The attendance has been deleted successfully.');
    }
    //force delete success notify
    protected function getForceDeletedNotification(): ?Notification
    {
        return Notification::make()
            ->success()
            ->title('Attendance Force Deleted')
            ->body('The attendance has been force deleted successfully.');
    }
    //restore success notify
    protected function getRestoredNotification(): ?Notification
    {
        return Notification::make()
            ->success()
            ->title('Attendance Restored')
            ->body('The attendance has been restored successfully.');
    }

}
