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
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class MedicalRecordsRelationManager extends RelationManager
{
    protected static string $relationship = 'medicalRecords';

    protected static ?string $title = 'Riwayat Kesehatan';

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                DatePicker::make('checkup_date')
                    ->label('Tanggal Periksa')
                    ->required(),
                TextInput::make('location')
                    ->label('Lokasi / RS')
                    ->required()
                    ->maxLength(255),
                TextInput::make('result')
                    ->label('Hasil (Fit/Unfit)')
                    ->required()
                    ->maxLength(255),
                Textarea::make('health_resume')
                    ->label('Resume Kesehatan')
                    ->columnSpan('full'),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('checkup_date')
            ->columns([
                TextColumn::make('checkup_date')->date()->label('Tanggal'),
                TextColumn::make('location')->label('Lokasi'),
                TextColumn::make('result')->label('Hasil')
                    ->badge()
                    ->color(fn(string $state): string => match ($state) {
                        'Fit' => 'success',
                        'Unfit' => 'danger',
                        'default' => 'gray',
                    }),
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
