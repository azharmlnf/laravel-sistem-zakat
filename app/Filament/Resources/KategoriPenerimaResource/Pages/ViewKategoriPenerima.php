<?php

namespace App\Filament\Resources\KategoriPenerimaResource\Pages;

use App\Filament\Resources\KategoriPenerimaResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewKategoriPenerima extends ViewRecord
{
    protected static string $resource = KategoriPenerimaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
