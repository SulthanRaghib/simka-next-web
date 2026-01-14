<?php

namespace App\Filament\Resources\Users\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use App\Filament\Resources\Users\UserResource as UsersResource;
use Filament\Tables\Table;
use Filament\Tables;

class UsersTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->recordUrl(null) // DISABLE ROW CLICK
            ->columns([
                Tables\Columns\TextColumn::make('nip')
                    ->label('NIP')
                    ->searchable()
                    ->url(static fn($record): string => UsersResource::getUrl('profile', ['record' => $record->nip ?? $record->getKey()]))
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
                EditAction::make()
                    ->url(static fn($record): string => UsersResource::getUrl('edit', ['record' => $record->nip ?? $record->getKey()])),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
