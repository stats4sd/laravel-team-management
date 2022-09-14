<?php

namespace Stats4sd\TeamManagement\Policies;

use Illuminate\Auth\Access\Response;
use Illuminate\Auth\Access\HandlesAuthorization;
use Stats4sd\TeamManagement\Models\Team;

class TeamPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     */
    public function viewAny($user) {
        return ($user->hasAnyRole(config('team-management.roles.admin'))) ? Response::allow()
        : Response::deny('Sorry, you do not have permissions to view details of all organisations.');;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view($user, Team $team)
    {
        return $team->users->contains($user) || $user->hasAnyRole(config('team-management.roles.admin'));
    }

    /**
     * Determine whether the user can create models.
     */
    public function create($user)    {
        return $user->hasAnyRole(config('team-management.roles.admin'));
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update($user, Team $team)
    {
        return $team->admins->contains($user) || $user->hasAnyRole(config('team-management.roles.admin'));
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete($user, Team $team)
    {
        return $user->hasRole(config('team-management.roles.admin'));
    }

    /**
     * Determine whether the user can restore the model
     */
    public function restore($user, Team $team)
    {
        return $team->admins->contains($user) || $user->hasAnyRole(config('team-management.roles.admin'));
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete($user, Team $team)
    {
        return $user->hasAnyRole(config('team-management.roles.admin'));
    }

}
