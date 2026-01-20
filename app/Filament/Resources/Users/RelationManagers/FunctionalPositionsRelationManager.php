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
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class FunctionalPositionsRelationManager extends RelationManager
{
    protected static string $relationship = 'functionalPositions';

    protected static ?string $title = 'Data Jabatan Fungsional Tertentu';

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('jft_name')
                    ->label('Nama JFT')
                    ->required()
                    ->maxLength(255),
                Select::make('agency_subminkal')
                    ->label('Instansi Subminkal')
                    ->options([
                        'Badan Kepegawaian Negara' => 'BKN',
                        'Kementerian/Lembaga' => 'K/L',
                        'Provinsi' => 'Provinsi',
                        'Kabupaten/Kota' => 'Kab/Kota',
                    ])
                    ->required(),
                Select::make('level_grade')
                    ->label('Jenjang/Gol')
                    ->options([
                        'Ahli Pertama' => 'Ahli Pertama',
                        'Ahli Muda' => 'Ahli Muda',
                        'Ahli Madya' => 'Ahli Madya',
                        'Ahli Utama' => 'Ahli Utama',
                    ]),
                DatePicker::make('start_date')
                    ->label('TMT Mulai')
                    ->required(),
                DatePicker::make('end_date')
                    ->label('TMT Selesai'),
                TextInput::make('decree_number')
                    ->label('No SK')
                    ->maxLength(255),
                DatePicker::make('decree_date')
                    ->label('Tanggal SK'),
                TextInput::make('credit_score')
                    ->label('Angka Kredit')
                    ->numeric()
                    ->scale(2),
                TextInput::make('status')
                    ->label('Status')
                    ->maxLength(255),
                TextInput::make('notes')
                    ->label('Keterangan')
                    ->maxLength(65535),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('jft_name')
            ->columns([
                TextColumn::make('jft_name')
                    ->searchable()
                    ->label('Nama JFT'),
                TextColumn::make('agency_subminkal')
                    ->label('Instansi Subminkal'),
                TextColumn::make('level_grade')
                    ->label('Jenjang/Gol'),
                TextColumn::make('start_date')
                    ->label('TMT Mulai')
                    ->date(),
                TextColumn::make('end_date')
                    ->label('TMT Selesai')
                    ->date(),
                TextColumn::make('decree_number')
                    ->label('No SK'),
                TextColumn::make('decree_date')
                    ->label('Tanggal SK')
                    ->date(),
                TextColumn::make('credit_score')
                    ->label('Angka Kredit'),
                TextColumn::make('status')
                    ->label('Status'),
                TextColumn::make('notes')
                    ->label('Keterangan'),
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
