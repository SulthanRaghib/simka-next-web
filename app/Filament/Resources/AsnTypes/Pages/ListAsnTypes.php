<?php

namespace App\Filament\Resources\AsnTypes\Pages;

use App\Filament\Resources\AsnTypes\AsnTypeResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListAsnTypes extends ListRecords
{
    protected static string $resource = AsnTypeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
