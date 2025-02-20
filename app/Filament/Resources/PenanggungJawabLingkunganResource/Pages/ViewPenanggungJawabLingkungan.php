<?php

namespace App\Filament\Resources\PenanggungJawabLingkunganResource\Pages;

use App\Filament\Resources\PenanggungJawabLingkunganResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewPenanggungJawabLingkungan extends ViewRecord
{
    protected static string $resource = PenanggungJawabLingkunganResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
