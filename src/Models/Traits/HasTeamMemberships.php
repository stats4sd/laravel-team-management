<?php

namespace Stats4sd\TeamManagement\Models\Traits;

use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Stats4sd\TeamManagement\Models\Invite;
use Stats4sd\TeamManagement\Models\RoleInvite;
use Stats4sd\TeamManagement\Models\Team;

/**
 * Add this trait to any class that can be a member of a team.
 *
 * Typically, this will be your App\Models\User class, but it could in theory be anythng;
 *
 */
trait HasTeamMemberships
{

    protected static function booted()
    {
        parent::booted();

        // handle newly created 'users' when they are created via an invite link
        static::created(function ($member) {

            // if the user was invited to one or more teams, assign them to the team(s)
            $invites = Invite::where('email', '=', $member->email)->get();

            foreach($invites as $invite) {
                $member->teams()->syncWithoutDetaching($invite->team->id);

                $invite->confirm();
            }

            // if the user was invited to one or more user roles, assign them to the role(s)
            $roleInvites = RoleInvite::where('email', '=', $member->email)->get();

            foreach($roleInvites as $invite) {
                $member->roles()->syncWithoutDetaching($invite->role->id);

                $invite->confirm();
            }
        });
    }


    public function teams(): BelongsToMany
    {
        return $this->belongsToMany(Team::class, 'team_members')->withPivot('is_admin');
    }

    /**
     * Relation to return all teams the user has created
     */
    public function owned_teams(): hasMany
    {
        return $this->hasMany(Team::class, 'creator_id');
    }

    public function invitesSent(): HasMany
    {
        return $this->hasMany(Invite::class, 'inviter_id');
    }


}
