<?php

namespace App\Filament\Resources\PenanggungJawabLingkunganResource\Pages;

use App\Filament\Resources\PenanggungJawabLingkunganResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditPenanggungJawabLingkungan extends EditRecord
{
    protected static string $resource = PenanggungJawabLingkunganResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }
}
