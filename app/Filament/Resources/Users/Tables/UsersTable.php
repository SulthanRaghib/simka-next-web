<?php

namespace App\Filament\Resources\Users\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Table;
use Filament\Tables;

class UsersTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('nip')
                    ->label('NIP')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('name')
                    ->label('Nama')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('rank.name')
                    ->label('Pangkat')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('workUnit.name')
                    ->label('Unit Kerja')
                    ->sortable()
                    ->searchable()
                    ->words(5),
                Tables\Columns\TextColumn::make('jobType.name')
                    ->label('Jenis Jabatan')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('structuralPosition.name')
                    ->label('Jabatan Struktural')
                    ->sortable()
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('employmentStatus.name')
                    ->label('Status')
                    ->badge()
                    ->color(fn(string $state): string => match ($state) {
                        'Aktif' => 'success',
                        'Pensiun' => 'danger',
                        default => 'gray',
                    })
                    ->sortable(),
                Tables\Columns\ToggleColumn::make('is_active')
                    ->label('Aktif'),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('work_unit_id')
                    ->label('Unit Kerja')
                    ->relationship('workUnit', 'name')
                    ->searchable()
                    ->preload(),
                Tables\Filters\SelectFilter::make('jenis_jab_id')
                    ->label('Jenis Jabatan')
                    ->relationship('jobType', 'name'),
                Tables\Filters\SelectFilter::make('employment_status_id')
                    ->label('Status')
                    ->relationship('employmentStatus', 'name'),
            ])
            ->recordActions([
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
