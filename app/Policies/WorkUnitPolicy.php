<?php

declare(strict_types=1);

namespace App\Policies;

use Illuminate\Foundation\Auth\User as AuthUser;
use App\Models\WorkUnit;
use Illuminate\Auth\Access\HandlesAuthorization;

class WorkUnitPolicy
{
    use HandlesAuthorization;
    
    public function viewAny(AuthUser $authUser): bool
    {
        return $authUser->can('ViewAny:WorkUnit');
    }

    public function view(AuthUser $authUser, WorkUnit $workUnit): bool
    {
        return $authUser->can('View:WorkUnit');
    }

    public function create(AuthUser $authUser): bool
    {
        return $authUser->can('Create:WorkUnit');
    }

    public function update(AuthUser $authUser, WorkUnit $workUnit): bool
    {
        return $authUser->can('Update:WorkUnit');
    }

    public function delete(AuthUser $authUser, WorkUnit $workUnit): bool
    {
        return $authUser->can('Delete:WorkUnit');
    }

    public function restore(AuthUser $authUser, WorkUnit $workUnit): bool
    {
        return $authUser->can('Restore:WorkUnit');
    }

    public function forceDelete(AuthUser $authUser, WorkUnit $workUnit): bool
    {
        return $authUser->can('ForceDelete:WorkUnit');
    }

    public function forceDeleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('ForceDeleteAny:WorkUnit');
    }

    public function restoreAny(AuthUser $authUser): bool
    {
        return $authUser->can('RestoreAny:WorkUnit');
    }

    public function replicate(AuthUser $authUser, WorkUnit $workUnit): bool
    {
        return $authUser->can('Replicate:WorkUnit');
    }

    public function reorder(AuthUser $authUser): bool
    {
        return $authUser->can('Reorder:WorkUnit');
    }

}