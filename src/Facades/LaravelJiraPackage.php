<?php

declare(strict_types=1);

namespace Alibori\LaravelJiraPackage\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Alibori\LaravelJiraPackage\LaravelJiraPackage
 */
class LaravelJiraPackage extends Facade
{
    protected static function getFacadeAccessor()
    {
        return \Alibori\LaravelJiraPackage\LaravelJiraPackage::class;
    }
}
