<?php

namespace App\Filament\Resources\UserResource\Pages;

use App\Filament\Resources\UserResource;
use App\Models\User;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Filament\Notifications\Notification;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;


class EditUser extends EditRecord
{
    protected static string $resource = UserResource::class;

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
    //edit notify success
    protected function getSavedNotification(): ?Notification
    {
        return Notification::make()
            ->success()
            ->title('User updated!')
            ->body('User ' . $this->getRecord()->name . ' has been updated!');
    }
    //delete notify success
    protected function getDeletedNotification(): ?Notification
    {
        return Notification::make()
            ->success()
            ->title('User deleted!')
            ->body('User ' . $this->getRecord()->name . ' has been deleted!');
    }
    //restore notify success
    protected function getRestoredNotification(): ?Notification
    {
        return Notification::make()
            ->success()
            ->title('User restored!')
            ->body('User ' . $this->getRecord()->name . ' has been restored!');
    }
    
    //force delete notify success
    protected function getForceDeletedNotification(): ?Notification
    {
        return Notification::make()
            ->success()
            ->title('User force deleted!')
            ->body('User ' . $this->getRecord()->name . ' has been force deleted!');
    }
}
