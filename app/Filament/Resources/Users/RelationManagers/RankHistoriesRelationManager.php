<?php

namespace App\Filament\Resources\Users\RelationManagers;

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
use Filament\Forms\Components\Textarea;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class RankHistoriesRelationManager extends RelationManager
{
    protected static string $relationship = 'rankHistories';

    protected static ?string $title = 'Data Pangkat dan Golongan';

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('status')
                    ->options([
                        'pns' => 'PNS',
                        'pppk' => 'PPPK',
                        'tni' => 'TNI',
                        'polri' => 'POLRI',
                    ])
                    ->label('Status')
                    ->required(),
                TextInput::make('rank_grade')
                    ->label('Pangkat/Golongan')
                    ->required(),
                DatePicker::make('effective_date')
                    ->label('TMT Pangkat')
                    ->required(),
                TextInput::make('promotion_type')
                    ->label('Jenis Kenaikan Pangkat')
                    ->required(),
                TextInput::make('service_period')
                    ->label('Masa Kerja')
                    ->default(null),
                TextInput::make('decree_number')
                    ->label('Nomor SK')
                    ->default(null),
                DatePicker::make('decree_date')
                    ->label('Tanggal SK')
                    ->default(null),
                Textarea::make('notes')
                    ->label('Keterangan')
                    ->default(null)
                    ->columnSpanFull(),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('rank_grade')
            ->columns([
                TextColumn::make('status')
                    ->label('Status')
                    ->searchable(),
                TextColumn::make('rank_grade')
                    ->label('Pangkat/Golongan')
                    ->searchable(),
                TextColumn::make('effective_date')
                    ->label('TMT Pangkat')
                    ->date()
                    ->sortable(),
                TextColumn::make('promotion_type')
                    ->label('Jenis Kenaikan Pangkat')
                    ->searchable(),
                TextColumn::make('service_period')
                    ->label('Masa Kerja')
                    ->searchable(),
                TextColumn::make('decree_number')
                    ->label('Nomor SK')
                    ->searchable(),
                TextColumn::make('decree_date')
                    ->label('Tanggal SK')
                    ->date()
                    ->sortable(),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
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
