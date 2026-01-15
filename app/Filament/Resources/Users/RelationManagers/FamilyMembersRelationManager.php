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
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class FamilyMembersRelationManager extends RelationManager
{
    protected static string $relationship = 'familyMembers';

    protected static ?string $title = 'Data Keluarga';

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('relationship')
                    ->label('Hubungan')
                    ->required()
                    ->maxLength(255),
                TextInput::make('name')
                    ->label('Nama Lengkap')
                    ->required()
                    ->maxLength(255),
                Select::make('gender')
                    ->label('Jenis Kelamin')
                    ->options([
                        'L' => 'Laki-laki',
                        'P' => 'Perempuan',
                    ])
                    ->required(),
                TextInput::make('place_of_birth')
                    ->label('Tempat Lahir')
                    ->required()
                    ->maxLength(255),
                TextInput::make('date_of_birth')
                    ->label('Tanggal Lahir')
                    ->type('date')
                    ->required(),
                Select::make('religion')
                    ->label('Agama')
                    ->options([
                        'Islam' => 'Islam',
                        'Kristen Protestan' => 'Kristen Protestan',
                        'Katolik' => 'Katolik',
                        'Hindu' => 'Hindu',
                        'Buddha' => 'Buddha',
                        'Konghucu' => 'Konghucu',
                    ])
                    ->required(),
                Select::make('education')
                    ->label('Pendidikan Terakhir')
                    ->options([
                        'Tidak/Belum Sekolah' => 'Tidak/Belum Sekolah',
                        'SD/Sederajat' => 'SD/Sederajat',
                        'SMP/Sederajat' => 'SMP/Sederajat',
                        'SMA/Sederajat' => 'SMA/Sederajat',
                        'Diploma' => 'Diploma',
                        'Sarjana' => 'Sarjana',
                        'Magister' => 'Magister',
                        'Doktor' => 'Doktor',
                    ])
                    ->required(),
                TextInput::make('occupation')
                    ->label('Pekerjaan')
                    ->required()
                    ->maxLength(255),
                TextInput::make('notes')
                    ->label('Keterangan')
                    ->maxLength(65535),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('name')
            ->columns([
                TextColumn::make('relationship')->label('Hubungan')->searchable(),
                TextColumn::make('name')->label('Nama Lengkap')->searchable(),
                TextColumn::make('gender')->label('Jenis Kelamin')->searchable(),
                TextColumn::make('date_of_birth')->label('Tanggal Lahir')->searchable(),
                TextColumn::make('education')->label('Pendidikan Terakhir')->searchable(),
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
