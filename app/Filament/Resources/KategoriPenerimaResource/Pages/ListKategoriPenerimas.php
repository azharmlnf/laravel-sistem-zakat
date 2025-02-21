<?php

namespace App\Filament\Resources\KategoriPenerimaResource\Pages;

use App\Filament\Resources\KategoriPenerimaResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListKategoriPenerimas extends ListRecords
{
    protected static string $resource = KategoriPenerimaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
