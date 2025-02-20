<?php

namespace App\Filament\Resources\JenisZakatResource\Pages;

use App\Filament\Resources\JenisZakatResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewJenisZakat extends ViewRecord
{
    protected static string $resource = JenisZakatResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
