<?php

declare(strict_types=1);

namespace App\Filament\Resources\Users\RelationManagers;

use Filament\Actions\CreateAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Schemas\Schema;
use Filament\Tables;
use Filament\Tables\Table;

class PositionDutiesRelationManager extends RelationManager
{
    protected static string $relationship = 'positionDuties';

    protected static ?string $title = 'Tugas & Fungsi Jabatan';

    public function form(Schema $form): Schema
    {
        return $form->components([
            Forms\Components\TextInput::make('title')
                ->label('Judul Tugas')
                ->required()
                ->maxLength(255),

            Forms\Components\Textarea::make('description')
                ->label('Deskripsi')
                ->rows(6)
                ->columnSpan('full'),

            Forms\Components\Select::make('position_type')
                ->label('Tipe Jabatan')
                ->options([
                    'structural' => 'Struktural',
                    'functional' => 'Fungsional',
                    'other' => 'Lainnya',
                ])
                ->placeholder('Jika relevan'),

            Forms\Components\TextInput::make('position_id')
                ->label('Position ID (optional)'),

            Forms\Components\TextInput::make('order')
                ->label('Urutan')
                ->numeric()
                ->default(0),

            Forms\Components\Toggle::make('is_active')
                ->label('Aktif')
                ->default(true),
        ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title')->label('Judul')->searchable(),
                Tables\Columns\TextColumn::make('position_type')->label('Tipe')->toggleable(),
                Tables\Columns\TextColumn::make('order')->label('Urutan')->sortable(),
                Tables\Columns\TextColumn::make('is_active')->label('Aktif')->formatStateUsing(fn($s) => $s ? 'Ya' : 'Tidak'),
                Tables\Columns\TextColumn::make('created_at')->label('Dibuat')->date(),
            ])
            ->headerActions([
                CreateAction::make(),
            ])
            ->recordActions([
                EditAction::make(),
                DeleteAction::make(),
            ])
            ->toolbarActions([
                DeleteBulkAction::make(),
            ]);
    }
}
