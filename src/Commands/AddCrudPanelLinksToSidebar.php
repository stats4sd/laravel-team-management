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

        $teamHeaderHtml = '<x-backpack::menu-separator title="Team Management" />';
        $teamLinkHtml = '<x-backpack::menu-item title="Teams" icon="la la-users" :link="backpack_url(\\\'team\\\')" />';
        $inviteLinkHtml = '<x-backpack::menu-item title="Team Invites" icon="la la-envelope" :link="backpack_url(\\\'invite\\\')" />';
        $roleInviteLinkHtml = '<x-backpack::menu-item title="Site-wide Invites" icon="la la-envelope" :link="backpack_url(\\\'role-invite\\\')" />';
        $userLinkHtml = '<x-backpack::menu-item title="Users" icon="la la-user" :link="backpack_url(\\\'user\\\')" />';

        Artisan::call("backpack:add-menu-content '$teamHeaderHtml'");
        Artisan::call("backpack:add-menu-content '$teamLinkHtml'");
        Artisan::call("backpack:add-menu-content '$inviteLinkHtml'");
        Artisan::call("backpack:add-menu-content '$roleInviteLinkHtml'");
        Artisan::call("backpack:add-menu-content '$userLinkHtml'");

        return 1;
    }
}
