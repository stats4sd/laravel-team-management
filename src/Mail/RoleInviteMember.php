<?php

namespace Stats4sd\TeamManagement\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Stats4sd\TeamManagement\Models\RoleInvite;

class RoleInviteMember extends Mailable
{
    use Queueable, SerializesModels;

    public $invite;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(RoleInvite $invite)
    {
        $this->invite = $invite;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from(config('mail.from.address'))
        ->subject(config('app.name'). ': Invitation To Join with the  ' . $this->invite->role->name . ' User Role')
        ->markdown('team-management::emails.role_invite');
    }
}
