<?php

namespace Stats4sd\TeamManagement\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;

class AddCrudPanelLinksToSidebar extends Command
{
    public $signature = 'team-management:crud';

    public $description = 'Adds links to the Backpack sidebar for: Team and RoleInvite Crud panels';

    public function handle(): int
    {
        $teamLinkHtml = '<li class="nav-item"><a class="nav-link" href="{{ backpack_url("team") }}"><i class="la la-users nav-icon"></i> Teams</a></li>';
        $inviteLinkHtml = '<li class="nav-item"><a class="nav-link" href="{{ backpack_url("invite") }}"><i class="la la-envelope nav-icon"></i> Team Invites</a></li>';
        $roleInviteLinkHtml = '<li class="nav-item"><a class="nav-link" href="{{ backpack_url("role-invite") }}"><i class="la la-envelope nav-icon"></i> Site-wide Invites</a></li>';

        Artisan::call("backpack:add-sidebar-content '$teamLinkHtml'");
        Artisan::call("backpack:add-sidebar-content '$inviteLinkHtml'");
        Artisan::call("backpack:add-sidebar-content '$roleInviteLinkHtml'");

        return 1;
    }
}
