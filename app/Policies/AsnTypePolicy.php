<?php

declare(strict_types=1);

namespace App\Policies;

use Illuminate\Foundation\Auth\User as AuthUser;
use App\Models\AsnType;
use Illuminate\Auth\Access\HandlesAuthorization;

class AsnTypePolicy
{
    use HandlesAuthorization;
    
    public function viewAny(AuthUser $authUser): bool
    {
        return $authUser->can('ViewAny:AsnType');
    }

    public function view(AuthUser $authUser, AsnType $asnType): bool
    {
        return $authUser->can('View:AsnType');
    }

    public function create(AuthUser $authUser): bool
    {
        return $authUser->can('Create:AsnType');
    }

    public function update(AuthUser $authUser, AsnType $asnType): bool
    {
        return $authUser->can('Update:AsnType');
    }

    public function delete(AuthUser $authUser, AsnType $asnType): bool
    {
        return $authUser->can('Delete:AsnType');
    }

    public function restore(AuthUser $authUser, AsnType $asnType): bool
    {
        return $authUser->can('Restore:AsnType');
    }

    public function forceDelete(AuthUser $authUser, AsnType $asnType): bool
    {
        return $authUser->can('ForceDelete:AsnType');
    }

    public function forceDeleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('ForceDeleteAny:AsnType');
    }

    public function restoreAny(AuthUser $authUser): bool
    {
        return $authUser->can('RestoreAny:AsnType');
    }

    public function replicate(AuthUser $authUser, AsnType $asnType): bool
    {
        return $authUser->can('Replicate:AsnType');
    }

    public function reorder(AuthUser $authUser): bool
    {
        return $authUser->can('Reorder:AsnType');
    }

}