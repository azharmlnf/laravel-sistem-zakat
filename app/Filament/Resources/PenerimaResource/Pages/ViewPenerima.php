<?php

namespace App\Filament\Resources\PenerimaResource\Pages;

use App\Filament\Resources\PenerimaResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewPenerima extends ViewRecord
{
    protected static string $resource = PenerimaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
