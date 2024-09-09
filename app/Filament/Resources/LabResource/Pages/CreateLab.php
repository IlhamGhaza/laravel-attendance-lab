<?php

namespace App\Filament\Resources\LabResource\Pages;

use App\Filament\Resources\LabResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateLab extends CreateRecord
{
    protected static string $resource = LabResource::class;
    public function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
