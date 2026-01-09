<?php

namespace App\Filament\Resources\Ranks\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class RankForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Pangkat / Golongan')
                    ->schema([
                        TextInput::make('name')
                            ->required()
                            ->maxLength(255),
                        TextInput::make('code')
                            ->maxLength(50),
                        TextInput::make('level')
                            ->numeric()
                            ->minValue(1),
                    ]),
            ]);
    }
}
