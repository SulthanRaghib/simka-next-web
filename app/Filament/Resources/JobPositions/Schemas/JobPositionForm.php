<?php

namespace App\Filament\Resources\JobPositions\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class JobPositionForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Job Position Details')
                    ->schema([
                        TextInput::make('name')
                            ->required()
                            ->maxLength(255),
                        TextInput::make('grade')
                            ->numeric()
                            ->minValue(1)
                            ->maxValue(20),
                    ]),
            ]);
    }
}
