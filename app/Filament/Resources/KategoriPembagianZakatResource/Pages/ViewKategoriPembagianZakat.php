<?php

namespace App\Filament\Resources\KategoriPembagianZakatResource\Pages;

use App\Filament\Resources\KategoriPembagianZakatResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewKategoriPembagianZakat extends ViewRecord
{
    protected static string $resource = KategoriPembagianZakatResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
