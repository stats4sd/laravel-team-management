<?php

namespace Stats4sd\TeamManagement\Observers;


use Illuminate\Support\Facades\Mail;
use Stats4sd\TeamManagement\Models\RoleInvite;

class RoleInviteObserver
{
    public function created(RoleInvite $invite)
    {
        Mail::to($invite->email)->send(new RoleInviteMember($invite));
    }
}
