<?php

namespace App\Policies;

use Illuminate\Foundation\Auth\User as AuthUser;
use App\Models\User as UserModel;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;

    public function viewAny(AuthUser $authUser): bool
    {
        return $authUser->can('ViewAny:User');
    }

    public function view(AuthUser $authUser, UserModel $model): bool
    {
        // Allow users to view their own profile regardless of broader permissions
        if ($authUser->getAuthIdentifier() === $model->getAuthIdentifier()) {
            return true;
        }

        return $authUser->can('View:User');
    }

    public function create(AuthUser $authUser): bool
    {
        return $authUser->can('Create:User');
    }

    public function update(AuthUser $authUser): bool
    {
        return $authUser->can('Update:User');
    }

    public function delete(AuthUser $authUser): bool
    {
        return $authUser->can('Delete:User');
    }

    public function deleteAny(\Illuminate\Foundation\Auth\User $authUser): bool
    {
        // Super admin bypass
        if (method_exists($authUser, 'hasRole') && $authUser->hasRole('super_admin')) {
            return true;
        }

        // Filament Shield convention: `delete_any_user`
        return $authUser->can('delete_any_user');
    }

    public function restore(AuthUser $authUser): bool
    {
        return $authUser->can('Restore:User');
    }

    public function forceDelete(AuthUser $authUser): bool
    {
        return $authUser->can('ForceDelete:User');
    }

    public function forceDeleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('ForceDeleteAny:User');
    }

    public function restoreAny(AuthUser $authUser): bool
    {
        return $authUser->can('RestoreAny:User');
    }

    public function replicate(AuthUser $authUser): bool
    {
        return $authUser->can('Replicate:User');
    }

    public function reorder(AuthUser $authUser): bool
    {
        return $authUser->can('Reorder:User');
    }
}
