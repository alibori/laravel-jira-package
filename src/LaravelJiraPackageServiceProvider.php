<?php

declare(strict_types=1);

namespace Alibori\LaravelJiraPackage;

use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;
use Alibori\LaravelJiraPackage\Commands\LaravelJiraPackageCommand;

class LaravelJiraPackageServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        $package
            ->name('laravel-jira-package')
            ->hasConfigFile('jira-package')
            ->hasViews()
            ->hasCommand(LaravelJiraPackageCommand::class);
    }
}
