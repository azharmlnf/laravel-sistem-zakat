<?php

namespace App\Filament\Resources\KategoriPembagianZakatResource\Pages;

use App\Filament\Resources\KategoriPembagianZakatResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditKategoriPembagianZakat extends EditRecord
{
    protected static string $resource = KategoriPembagianZakatResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }
}
