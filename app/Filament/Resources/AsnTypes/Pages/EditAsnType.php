<?php

namespace App\Filament\Resources\AsnTypes\Pages;

use App\Filament\Resources\AsnTypes\AsnTypeResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditAsnType extends EditRecord
{
    protected static string $resource = AsnTypeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
