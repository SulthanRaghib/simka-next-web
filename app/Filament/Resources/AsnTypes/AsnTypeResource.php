<?php

namespace App\Filament\Resources\AsnTypes;

use App\Filament\Resources\AsnTypes\Pages\CreateAsnType;
use App\Filament\Resources\AsnTypes\Pages\EditAsnType;
use App\Filament\Resources\AsnTypes\Pages\ListAsnTypes;
use App\Filament\Resources\AsnTypes\Schemas\AsnTypeForm;
use App\Filament\Resources\AsnTypes\Tables\AsnTypesTable;
use App\Models\AsnType;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;

class AsnTypeResource extends Resource
{
    protected static ?string $model = AsnType::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedIdentification;

    protected static string|UnitEnum|null $navigationGroup = 'Data Master';

    public static function form(Schema $schema): Schema
    {
        return AsnTypeForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return AsnTypesTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListAsnTypes::route('/'),
            'create' => CreateAsnType::route('/create'),
            'edit' => EditAsnType::route('/{record}/edit'),
        ];
    }
}
