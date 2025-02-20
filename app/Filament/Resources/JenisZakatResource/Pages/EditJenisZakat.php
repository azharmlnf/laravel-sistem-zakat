<?php

namespace App\Filament\Resources\JenisZakatResource\Pages;

use App\Filament\Resources\JenisZakatResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditJenisZakat extends EditRecord
{
    protected static string $resource = JenisZakatResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }
}
