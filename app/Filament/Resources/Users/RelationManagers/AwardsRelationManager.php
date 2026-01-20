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
use Illuminate\Support\Facades\Date;

class AwardsRelationManager extends RelationManager
{
    protected static string $relationship = 'awards';

    protected static ?string $title = 'Penghargaan dan Tanda Jasa';

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('award_name')
                    ->label('Nama Penghargaan')
                    ->required()
                    ->maxLength(255),
                TextInput::make('year')
                    ->label('Tahun')
                    ->type('number')
                    ->required(),
                DatePicker::make('decree_date')
                    ->label('Tanggal SK')
                    ->nullable(),
                TextInput::make('decree_number')
                    ->label('Nomor SK')
                    ->nullable()
                    ->maxLength(255),
                TextInput::make('awarding_body')
                    ->label('Pemberi Penghargaan')
                    ->required()
                    ->maxLength(255),
                TextInput::make('notes')
                    ->label('Keterangan')
                    ->nullable()
                    ->maxLength(65535),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('award_name')
            ->columns([
                TextColumn::make('award_name')
                    ->searchable(),
                TextColumn::make('year')
                    ->searchable(),
                TextColumn::make('decree_date')
                    ->date()
                    ->sortable(),
                TextColumn::make('decree_number')
                    ->searchable(),
                TextColumn::make('awarding_body')
                    ->searchable(),
                TextColumn::make('notes')
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
