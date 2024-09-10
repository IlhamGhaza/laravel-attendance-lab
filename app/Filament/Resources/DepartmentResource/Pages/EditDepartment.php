<?php

namespace App\Filament\Resources\DepartmentResource\Pages;

use App\Filament\Resources\DepartmentResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Filament\Notifications\Notification;

class EditDepartment extends EditRecord
{
    protected static string $resource = DepartmentResource::class;

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
    protected function getSavedNotification(): ?Notification
    {
        return Notification::make()
            ->success()
            ->title('Department Updated')
            ->body('The department has been updated successfully.');
    }
    //edit success notify
    protected function getDeletedNotification(): ?Notification
    {
        return Notification::make()
            ->success()
            ->title('Department Deleted')
            ->body('The department has been deleted successfully.');
    }
    protected function getForceDeletedNotification(): ?Notification
    {
        return Notification::make()
            ->success()
            ->title('Department Force Deleted')
            ->body('The department has been force deleted successfully.');
    }
    protected function getRestoredNotification(): ?Notification
    {
        return Notification::make()
            ->success()
            ->title('Department Restored')
            ->body('The department has been restored successfully.');
    }
}
