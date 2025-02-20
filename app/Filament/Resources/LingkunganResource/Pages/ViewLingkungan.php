<?php

namespace App\Filament\Resources\LingkunganResource\Pages;

use App\Filament\Resources\LingkunganResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewLingkungan extends ViewRecord
{
    protected static string $resource = LingkunganResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
