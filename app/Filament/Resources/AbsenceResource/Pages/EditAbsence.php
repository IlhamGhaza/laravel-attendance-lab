<?php

namespace App\Filament\Resources\AbsenceResource\Pages;

use App\Filament\Resources\AbsenceResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

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
}
