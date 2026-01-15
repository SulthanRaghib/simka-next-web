<?php

namespace App\Filament\Resources\Users;

use App\Filament\Resources\Users\Pages;
use App\Filament\Resources\Users\RelationManagers\FamilyMembersRelationManager;
use App\Filament\Resources\Users\RelationManagers\HobbiesRelationManager;
use App\Filament\Resources\Users\RelationManagers\InsurancesRelationManager;
use App\Filament\Resources\Users\RelationManagers\MedicalRecordsRelationManager;
use App\Filament\Resources\Users\Schemas\UserForm;
use App\Filament\Resources\Users\Tables\UsersTable;
use App\Models\User;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;
use UnitEnum;

class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $recordRouteKeyName = 'nip';

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedUserGroup;

    protected static string|UnitEnum|null $navigationGroup = 'Manajemen Pegawai';

    protected static ?string $navigationLabel = 'Data Pegawai';

    public static function form(Schema $schema): Schema
    {
        return UserForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return UsersTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            FamilyMembersRelationManager::class,
            MedicalRecordsRelationManager::class,
            InsurancesRelationManager::class,
            HobbiesRelationManager::class,
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        $query = parent::getEloquentQuery();

        // FILAMENT SHIELD / ROLE CHECK
        // If user is not super_admin, limit query to their own ID.
        $user = Auth::user();

        if (!$user) {
            return $query;
        }

        if (! method_exists($user, 'hasRole') || ! $user->hasRole('super_admin')) {
            $query->where($user->getAuthIdentifierName(), $user->getAuthIdentifier());
        }

        return $query;
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'edit' => Pages\EditUser::route('/{record}/edit'),
            'profile' => Pages\EmployeeProfile::route('/{record}/profile'),
        ];
    }
}
