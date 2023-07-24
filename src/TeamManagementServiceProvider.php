<?php

namespace Stats4sd\TeamManagement;

use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Route;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;
use Stats4sd\TeamManagement\Commands\AddCrudPanelLinksToSidebar;
use Stats4sd\TeamManagement\Models\Team;
use Stats4sd\TeamManagement\Policies\TeamPolicy;

class TeamManagementServiceProvider extends PackageServiceProvider
{
    protected $policies = [
        Team::class => TeamPolicy::class,
    ];

    public function registerPolicies()
    {
        foreach ($this->policies as $key => $value) {
            Gate::policy($key, $value);
        }
    }

    public function configurePackage(Package $package): void
    {
        /*
         * This class is a Package Service Provider
         *
         * More info: https://github.com/spatie/laravel-package-tools
         */
        $package
            ->name('laravel-team-management')
            ->hasConfigFile()
            ->hasViews()
            ->hasMigrations([
                '1_create_teams_table',
                '2_create_role_invites_table',
                '3_create_invites_table',
                '4_create_team_members_table',
            ])
            ->hasCommand(AddCrudPanelLinksToSidebar::class);
    }

    public function boot()
    {
        // register the team policy
        $this->registerPolicies();

        //handle routes manually, as we want to let the user override the package routes in the main app:
        $this->publishes([
            __DIR__.'/../routes/team-management.php' => base_path('routes/backpack/team-management.php')
        ], 'team-management-routes');

        // if the user has published the routes file, do not register the package routes.
        if(file_exists(base_path('routes/backpack/team-management.php'))) {
            $this->loadRoutesFrom(base_path('routes/backpack/team-management.php'));
        } else {
            $this->loadRoutesFrom(__DIR__.'/../routes/team-management.php');
        }

        return parent::boot();
    }
}
