<?php

namespace Stats4sd\TeamManagement\Observers;


use Illuminate\Support\Facades\Mail;
use Stats4sd\TeamManagement\Mail\InviteMember;
use Stats4sd\TeamManagement\Models\Invite;

class InviteObserver
{
    /**
     * Handle the Invite "created" event.

     */
    public function created(Invite $invite)
    {
        Mail::to($invite->email)->send(new InviteMember($invite));
    }
}
