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

        $teamDropdownHtml = '<x-backpack::menu-dropdown title="Authentication" icon="la la-group">
    <x-backpack::menu-dropdown-item title="Users" icon="la la-user" :link="backpack_url(\\\'user\\\')" />
    <x-backpack::menu-dropdown-item title="Roles" icon="la la-group" :link="backpack_url(\\\'role\\\')" />
    <x-backpack::menu-dropdown-item title="Permissions" icon="la la-key" :link="backpack_url(\\\'permission\\\')" />
</x-backpack::menu-dropdown>';

        $userLinkHtml = '<x-backpack::menu-item title="Users" icon="la la-user" :link="backpack_url(\\\'user\\\')" />';

        Artisan::call("backpack:add-menu-content '$teamDropdownHtml'");
        Artisan::call("backpack:add-menu-content '$userLinkHtml'");

        return 1;
    }
}
