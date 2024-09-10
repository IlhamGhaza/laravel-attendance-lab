<?php

namespace App\Filament\Resources\UserResource\Pages;

use App\Filament\Resources\UserResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Filament\Notifications\Notification;


class CreateUser extends CreateRecord
{
    protected static string $resource = UserResource::class;
    public function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
    //notification succes
    protected function getCreatedNotification(): ?Notification
    {
        return Notification::make()
                ->title('User created')
                ->body('User has been created successfully.')
                ->success();
    }
}
