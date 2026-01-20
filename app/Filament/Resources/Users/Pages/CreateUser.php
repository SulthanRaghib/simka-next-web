<?php

namespace App\Filament\Resources\Users\Pages;

use App\Filament\Resources\Users\UserResource;
use Filament\Resources\Pages\CreateRecord;

class CreateUser extends CreateRecord
{
    protected static string $resource = UserResource::class;

    protected function getRedirectUrl(): string
    {
        // Redirect to Edit page after creation so user can immediately add relations (Family, Medical, etc.)
        return $this->getResource()::getUrl('edit', ['record' => $this->record]);
    }
}
