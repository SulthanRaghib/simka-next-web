<?php

namespace App\Filament\Resources\Users\RelationManagers;

use Dom\Text;
use Filament\Actions\AssociateAction;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\CreateAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\DissociateAction;
use Filament\Actions\DissociateBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class StructuralPositionsRelationManager extends RelationManager
{
    protected static string $relationship = 'structuralPositions';

    protected static ?string $title = 'Data Jabatan Struktural';

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('position_name')
                    ->label('Nama Jabatan')
                    ->required()
                    ->maxLength(255),
                Select::make('work_unit_id')
                    ->label('Unit Kerja/Instansi')
                    ->relationship('workUnit', 'name')
                    ->required(),
                TextInput::make('decree_number')
                    ->label('Nomor SK')
                    ->required()
                    ->maxLength(255),
                DatePicker::make('decree_date')
                    ->label('Tanggal SK')
                    ->required(),
                TextInput::make('echelon')
                    ->label('Eselon')
                    ->required()
                    ->maxLength(255),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('position_name')
            ->columns([
                TextColumn::make('position_name')
                    ->label('Nama Jabatan')
                    ->searchable(),
                TextColumn::make('workUnit.name')
                    ->label('Unit Kerja/Instansi')
                    ->searchable(),
                TextColumn::make('decree_number')
                    ->label('Nomor SK')
                    ->searchable(),
                TextColumn::make('decree_date')
                    ->label('Tanggal SK')
                    ->date()
                    ->sortable(),
                TextColumn::make('echelon')
                    ->label('Eselon')
                    ->searchable(),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                CreateAction::make(),
            ])
            ->recordActions([
                EditAction::make(),
                DeleteAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
