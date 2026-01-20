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
use Filament\Forms\Components\TextInput;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Support\Facades\Date;

class SalaryIncreasesRelationManager extends RelationManager
{
    protected static string $relationship = 'salaryIncreases';

    protected static ?string $title = 'Data Kenaikan Gaji Berkala (KGB)';

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('decree_number')
                    ->label('Nomor SK')
                    ->required()
                    ->maxLength(255),
                DatePicker::make('decree_date')
                    ->label('Tanggal SK')
                    ->required(),
                TextInput::make('grade')
                    ->label('Golongan')
                    ->required()
                    ->maxLength(255),
                TextInput::make('service_period')
                    ->label('Masa Kerja')
                    ->required()
                    ->maxLength(255),
                TextInput::make('salary_amount')
                    ->label('Besaran Gaji')
                    ->required(),
                DatePicker::make('effective_date')
                    ->label('TMT Gaji')
                    ->required(),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('decree_number')
            ->columns([
                TextColumn::make('decree_number')
                    ->label('Nomor SK')
                    ->searchable(),
                TextColumn::make('decree_date')
                    ->label('Tanggal SK')
                    ->date()
                    ->sortable(),
                TextColumn::make('grade')
                    ->label('Golongan')
                    ->searchable(),
                TextColumn::make('service_period')
                    ->label('Masa Kerja')
                    ->searchable(),
                TextColumn::make('salary_amount')
                    ->label('Besaran Gaji')
                    ->money('idr', true)
                    ->sortable(),
                TextColumn::make('effective_date')
                    ->label('TMT Gaji')
                    ->date()
                    ->sortable(),
                TextColumn::make('created_at')
                    ->label('Dibuat Pada')
                    ->dateTime()
                    ->sortable(),
                TextColumn::make('updated_at')
                    ->label('Diperbarui Pada')
                    ->dateTime()
                    ->sortable()
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
