<?php

namespace App\Filament\Resources\JobTypes;

use App\Filament\Resources\JobTypes\Pages\CreateJobType;
use App\Filament\Resources\JobTypes\Pages\EditJobType;
use App\Filament\Resources\JobTypes\Pages\ListJobTypes;
use App\Filament\Resources\JobTypes\Schemas\JobTypeForm;
use App\Filament\Resources\JobTypes\Tables\JobTypesTable;
use App\Models\JobType;
use BackedEnum;
use Filament\Resources\Resource;
use UnitEnum;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class JobTypeResource extends Resource
{
    protected static ?string $model = JobType::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedBriefcase;

    protected static string|UnitEnum|null $navigationGroup = 'Data Master';

    public static function form(Schema $schema): Schema
    {
        return JobTypeForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return JobTypesTable::configure($table);
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
            'index' => ListJobTypes::route('/'),
            'create' => CreateJobType::route('/create'),
            'edit' => EditJobType::route('/{record}/edit'),
        ];
    }
}
