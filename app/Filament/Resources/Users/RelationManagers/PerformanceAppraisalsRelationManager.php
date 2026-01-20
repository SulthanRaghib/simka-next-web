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
use Filament\Forms\Components\TextInput;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class PerformanceAppraisalsRelationManager extends RelationManager
{
    protected static string $relationship = 'performanceAppraisals';

    protected static ?string $title = 'Data DP3';

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('year')
                    ->label('Tahun')
                    ->required()
                    ->maxLength(255),
                TextInput::make('loyalty_score')
                    ->label('Kesetiaan')
                    ->required(),
                TextInput::make('achievement_score')
                    ->label('Prestasi Kerja')
                    ->required(),
                TextInput::make('responsibility_score')
                    ->label('Tanggung Jawab')
                    ->required(),
                TextInput::make('obedience_score')
                    ->label('Ketaatan')
                    ->required(),
                TextInput::make('honesty_score')
                    ->label('Kejujuran')
                    ->required(),
                TextInput::make('cooperation_score')
                    ->label('Kerjasama')
                    ->required(),
                TextInput::make('initiative_score')
                    ->label('Prakarsa')
                    ->required(),
                TextInput::make('leadership_score')
                    ->label('Kepemimpinan')
                    ->required(),
                TextInput::make('total_score')
                    ->label('Total Nilai')
                    ->required(),
                TextInput::make('rating')
                    ->label('Sebutan')
                    ->required()
                    ->maxLength(255),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('year')
            ->columns([
                TextColumn::make('year')
                    ->label('Tahun')
                    ->searchable(),
                TextColumn::make('loyalty_score')
                    ->label('Kesetiaan'),
                TextColumn::make('achievement_score')
                    ->label('Prestasi Kerja'),
                TextColumn::make('responsibility_score')
                    ->label('Tanggung Jawab'),
                TextColumn::make('obedience_score')
                    ->label('Ketaatan'),
                TextColumn::make('honesty_score')
                    ->label('Kejujuran'),
                TextColumn::make('cooperation_score')
                    ->label('Kerjasama'),
                TextColumn::make('initiative_score')
                    ->label('Prakarsa'),
                TextColumn::make('leadership_score')
                    ->label('Kepemimpinan'),
                TextColumn::make('total_score')
                    ->label('Total Nilai'),
                TextColumn::make('rating')
                    ->label('Sebutan'),
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
