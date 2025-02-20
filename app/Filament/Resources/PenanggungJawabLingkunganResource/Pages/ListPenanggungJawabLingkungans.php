<?php

namespace App\Filament\Resources\PenanggungJawabLingkunganResource\Pages;

use App\Filament\Resources\PenanggungJawabLingkunganResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListPenanggungJawabLingkungans extends ListRecords
{
    protected static string $resource = PenanggungJawabLingkunganResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
