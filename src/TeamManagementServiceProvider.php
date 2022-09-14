<?php

namespace Stats4sd\TeamManagement;

use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;
use Stats4sd\TeamManagement\Commands\TeamManagementCommand;

class TeamManagementServiceProvider extends PackageServiceProvider
{
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
}
