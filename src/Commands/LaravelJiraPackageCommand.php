<?php

declare(strict_types=1);

namespace Alibori\LaravelJiraPackage\Commands;

use Illuminate\Console\Command;

class LaravelJiraPackageCommand extends Command
{
    public $signature = 'laravel-jira-package';

    public $description = 'My command';

    public function handle(): int
    {
        $this->comment('All done');

        return self::SUCCESS;
    }
}
