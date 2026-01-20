<?php

namespace App\Filament\Resources\Users\Schemas;

use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Filament\Forms;
use Filament\Schemas\Components\Utilities\Get;
use Illuminate\Support\Facades\Auth;
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
                            ->required(fn(string $context): bool => $context === 'create')
                            ->disabled(static fn(): bool => !self::currentUserCanManageRoles())
                            ->helperText(static fn(): ?string => self::currentUserCanManageRoles() ? null : 'Hanya super_admin yang dapat mengganti role.'),

                        Forms\Components\Toggle::make('is_active')
                            ->label('Active User')
                            ->default(true),
                    ]),

                Section::make('Data Tambahan (Hanya saat Create)')
                    ->description('Anda dapat menambahkan data keluarga langsung di sini. Setelah disimpan, data ini dapat diedit melalui tab khusus.')
                    ->visibleOn('create')
                    ->collapsed() // Default tertutup
                    ->schema([
                        Forms\Components\Repeater::make('familyMembers')
                            ->relationship()
                            ->label('Anggota Keluarga')
                            ->schema([
                                Forms\Components\TextInput::make('relationship')
                                    ->label('Hubungan')
                                    ->required()
                                    ->maxLength(255),
                                Forms\Components\TextInput::make('name')
                                    ->label('Nama Lengkap')
                                    ->required()
                                    ->maxLength(255),
                                Forms\Components\Select::make('gender')
                                    ->label('Jenis Kelamin')
                                    ->options([
                                        'L' => 'Laki-laki',
                                        'P' => 'Perempuan',
                                    ])
                                    ->required(),
                                Forms\Components\TextInput::make('place_of_birth')
                                    ->label('Tempat Lahir')
                                    ->maxLength(255),
                                Forms\Components\DatePicker::make('date_of_birth')
                                    ->label('Tanggal Lahir'),
                                Forms\Components\Select::make('education')
                                    ->label('Pendidikan Terakhir')
                                    ->options([
                                        'SD/Sederajat' => 'SD/Sederajat',
                                        'SMP/Sederajat' => 'SMP/Sederajat',
                                        'SMA/Sederajat' => 'SMA/Sederajat',
                                        'Diploma' => 'Diploma',
                                        'Sarjana' => 'Sarjana',
                                        'Magister' => 'Magister',
                                        'Doktor' => 'Doktor',
                                    ]),
                            ])
                            ->columns(2)
                            ->itemLabel(fn(array $state): ?string => $state['name'] ?? null),
                    ])
            ]);
    }

    protected static function currentUserCanManageRoles(): bool
    {
        if (!Auth::check()) {
            return false;
        }

        $user = Auth::user();

        if (!$user) {
            return false;
        }

        if (method_exists($user, 'getRoleNames')) {
            $roleNames = call_user_func([$user, 'getRoleNames']);

            if ($roleNames instanceof \Illuminate\Support\Collection) {
                return $roleNames->contains('super_admin');
            }

            if (is_array($roleNames)) {
                return in_array('super_admin', $roleNames, true);
            }
        }

        if (method_exists($user, 'roles')) {
            $roles = call_user_func([$user, 'roles']);

            if ($roles instanceof \Illuminate\Database\Eloquent\Relations\Relation) {
                return $roles->where('name', 'super_admin')->exists();
            }

            if ($roles instanceof \Illuminate\Support\Collection) {
                return $roles->contains('name', 'super_admin');
            }
        }

        $role = data_get($user, 'role.name');

        if (is_string($role)) {
            return $role === 'super_admin';
        }

        $rolesList = data_get($user, 'roles', []);

        if ($rolesList instanceof \Illuminate\Support\Collection) {
            return $rolesList->contains(function ($roleItem) {
                return data_get($roleItem, 'name') === 'super_admin';
            });
        }

        if (is_array($rolesList)) {
            foreach ($rolesList as $roleItem) {
                if (data_get($roleItem, 'name') === 'super_admin' || $roleItem === 'super_admin') {
                    return true;
                }
            }
        }

        return false;
    }
}
