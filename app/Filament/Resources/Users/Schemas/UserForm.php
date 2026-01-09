<?php

namespace App\Filament\Resources\Users\Schemas;

use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Filament\Forms;
use Filament\Schemas\Components\Utilities\Get;
use Illuminate\Support\Facades\Hash;
use Ramsey\Collection\Set;

class UserForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->columns(1)
            ->schema([
                Section::make('Input Master Pegawai')
                    ->columns(3)
                    ->schema([
                        Forms\Components\TextInput::make('nip')
                            ->label('NIP')
                            ->required()
                            ->unique(ignoreRecord: true)
                            ->maxLength(255)
                            ->belowContent('Untuk PNS (18 Digit), PPN/KTR/Honorer (9 Digit)')
                            ->columnSpan(1),

                        Forms\Components\TextInput::make('name')
                            ->label('Nama untuk Database')
                            ->required()
                            ->maxLength(255)
                            ->readOnly()
                            ->belowContent('Terisi otomatis berdasarkan Nama Cetak Tanpa Gelar')
                            ->columnSpan(2),

                        Forms\Components\TextInput::make('nama_cetak_tanpa_gelar')
                            ->label('Nama Cetak Tanpa Gelar')
                            ->maxLength(255)
                            ->columnSpan(1)
                            ->live(debounce: 500)
                            ->afterStateUpdated(function ($get, $set, ?string $state) {
                                if (blank($state)) {
                                    $set('name', null);
                                    return;
                                }

                                $parts = array_values(array_filter(explode(' ', trim($state))));
                                $count = count($parts);

                                if ($count === 0) {
                                    $set('name', null);
                                    return;
                                }

                                if ($count === 1) {
                                    $randomChar = chr(rand(97, 122));
                                    $generatedName = $randomChar . '.' . strtolower($parts[0]);
                                } else {
                                    $firstChar = substr($parts[0], 0, 1);
                                    $twoWords = implode('', array_slice($parts, 0, 2));
                                    $generatedName = strtolower($firstChar . '.' . $twoWords);
                                }

                                $set('name', $generatedName);
                            }),

                        Forms\Components\TextInput::make('nama_cetak_dengan_gelar')
                            ->label('Nama Cetak Dengan Gelar')
                            ->maxLength(255)
                            ->columnSpan(2),
                    ]),

                Section::make('Biodata')
                    ->columns(3)
                    ->schema([
                        Forms\Components\Select::make('gender')
                            ->label('Jenis Kelamin')
                            ->options([
                                'L' => 'Pria (L)',
                                'P' => 'Wanita (P)',
                            ])
                            ->columnSpan(1),

                        Forms\Components\TextInput::make('birth_place')
                            ->label('Tempat Lahir')
                            ->maxLength(255)
                            ->columnSpan(1),

                        Forms\Components\DatePicker::make('birth_date')
                            ->label('Tanggal Lahir')
                            ->columnSpan(1),
                    ]),

                Section::make('Kepegawaian')
                    ->columns(3)
                    ->schema([
                        Forms\Components\Select::make('pangkat_golongan_id')
                            ->label('Pangkat/Golongan')
                            ->relationship('rank', 'name')
                            ->searchable()
                            ->preload()
                            ->columnSpan(1),

                        Forms\Components\DatePicker::make('tmt_golongan')
                            ->label('TMT Golongan')
                            ->columnSpan(1),

                        Forms\Components\Select::make('jenis_asn_id')
                            ->label('Jenis ASN')
                            ->relationship('asnType', 'name')
                            ->searchable()
                            ->preload()
                            ->columnSpan(1),

                        Forms\Components\Select::make('work_unit_id')
                            ->label('Unit Kerja')
                            ->relationship('workUnit', 'name')
                            ->searchable()
                            ->preload()
                            ->columnSpanFull(),
                    ]),

                Section::make('Jabatan & Status')
                    ->columns(3)
                    ->schema([
                        Forms\Components\Select::make('jenis_jab_id')
                            ->label('Jenis Jabatan')
                            ->relationship('jobType', 'name')
                            ->searchable()
                            ->preload()
                            ->columnSpan(1),

                        Forms\Components\Select::make('struktural_position_id')
                            ->label('Jabatan Struktural')
                            ->relationship('structuralPosition', 'name')
                            ->searchable()
                            ->preload()
                            ->columnSpan(1),

                        Forms\Components\Select::make('employment_status_id')
                            ->label('Status Bekerja')
                            ->relationship('employmentStatus', 'name')
                            ->searchable()
                            ->preload()
                            ->columnSpan(1),

                        Forms\Components\Select::make('job_position_id')
                            ->label('Jabatan')
                            ->relationship('jobPosition', 'name')
                            ->searchable()
                            ->preload()
                            ->visible(false),
                    ]),

                Section::make('Login Information')
                    ->columns(2)
                    ->schema([
                        Forms\Components\TextInput::make('email')
                            ->email()
                            ->required()
                            ->maxLength(255),

                        Forms\Components\TextInput::make('password')
                            ->password()
                            ->dehydrateStateUsing(fn($state) => Hash::make($state))
                            ->dehydrated(fn($state) => filled($state))
                            ->required(fn(string $context): bool => $context === 'create')
                            ->revealable()
                            ->maxLength(255),

                        Forms\Components\Select::make('roles')
                            ->relationship('roles', 'name')
                            ->multiple()
                            ->preload()
                            ->searchable()
                            ->required(),

                        Forms\Components\Toggle::make('is_active')
                            ->label('Active User')
                            ->default(true),
                    ])
            ]);
    }
}
