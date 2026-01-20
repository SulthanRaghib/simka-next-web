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
use Filament\Forms\Components\TextInput;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class OtherPositionsRelationManager extends RelationManager
{
    protected static string $relationship = 'otherPositions';

    protected static ?string $title = 'Data Jabatan Lainnya';

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('position_name')
                    ->label('Nama Jabatan')
                    ->required()
                    ->maxLength(255),
                TextInput::make('agency')
                    ->label('Instansi')
                    ->required()
                    ->maxLength(255),
                DatePicker::make('start_date')
                    ->label('TMT Mulai')
                    ->required(),
                DatePicker::make('end_date')
                    ->label('TMT Selesai')
                    ->nullable(),
                TextInput::make('decree_number')
                    ->label('Nomor SK')
                    ->required()
                    ->maxLength(255),
                TextInput::make('decree_date')
                    ->label('Tanggal SK')
                    ->required(),
                TextInput::make('notes')
                    ->label('Keterangan')
                    ->nullable()
                    ->maxLength(500),
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
                TextColumn::make('agency')
                    ->label('Instansi')
                    ->searchable(),
                TextColumn::make('start_date')
                    ->label('TMT Mulai')
                    ->date(),
                TextColumn::make('end_date')
                    ->label('TMT Selesai')
                    ->date(),
                TextColumn::make('decree_number')
                    ->label('Nomor SK')
                    ->searchable(),
                TextColumn::make('decree_date')
                    ->label('Tanggal SK')
                    ->date(),
                TextColumn::make('notes')
                    ->label('Keterangan')
                    ->limit(50),
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
