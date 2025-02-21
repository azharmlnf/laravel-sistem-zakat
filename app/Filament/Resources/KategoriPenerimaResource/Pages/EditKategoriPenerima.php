<?php

namespace App\Filament\Resources\KategoriPenerimaResource\Pages;

use App\Filament\Resources\KategoriPenerimaResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditKategoriPenerima extends EditRecord
{
    protected static string $resource = KategoriPenerimaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }
}
