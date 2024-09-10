<?php

namespace App\Filament\Resources\BuildingResource\Pages;

use App\Filament\Resources\BuildingResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Filament\Notifications\Notification;

class CreateBuilding extends CreateRecord
{
    protected static string $resource = BuildingResource::class;
    public function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
    //success notify
    protected function getSavedNotification(): ?Notification
    {
        return Notification::make()
            ->success()
            ->title('Building Created')
            ->body('The building has been created successfully.');
    }
}
