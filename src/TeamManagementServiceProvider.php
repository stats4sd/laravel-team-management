<?php

namespace Stats4sd\TeamManagement;

use Illuminate\Support\Facades\Gate;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;
use Stats4sd\TeamManagement\Commands\TeamManagementCommand;
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
            ->hasViews();
    }

    public function boot()
    {
        $this->registerPolicies();
        return parent::boot();
    }
}
