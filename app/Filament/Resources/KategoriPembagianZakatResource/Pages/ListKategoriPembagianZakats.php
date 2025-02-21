<?php

namespace App\Filament\Resources\KategoriPembagianZakatResource\Pages;

use App\Filament\Resources\KategoriPembagianZakatResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListKategoriPembagianZakats extends ListRecords
{
    protected static string $resource = KategoriPembagianZakatResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
