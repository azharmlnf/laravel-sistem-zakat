<?php

namespace App\Filament\Resources\LingkunganResource\Pages;

use App\Filament\Resources\LingkunganResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditLingkungan extends EditRecord
{
    protected static string $resource = LingkunganResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }
}
