# Laravel Jira Package

[![Latest Version on Packagist](https://img.shields.io/packagist/v/alibori/laravel-jira-package.svg?style=flat-square)](https://packagist.org/packages/alibori/laravel-jira-package)
[![PHPStan](https://github.com/alibori/laravel-jira-package/actions/workflows/phpstan.yml/badge.svg)](https://github.com/alibori/laravel-jira-package/actions/workflows/phpstan.yml)
[![Total Downloads](https://img.shields.io/packagist/dt/alibori/laravel-jira-package.svg?style=flat-square)](https://packagist.org/packages/alibori/laravel-jira-package)

This package is a wrapper for the Jira API. It allows you to interact with Jira within your Laravel application.

## Requirements

You need to have a Jira account with a PAT (Personal Access Token) to use this package.

## Installation

You can install the package via composer:

```bash
composer require alibori/laravel-jira-package
```

You can publish the config file with:

```bash
php artisan vendor:publish --tag="jira-package-config"
```

## Configuration

To make the package work, you need to add your Jira credentials to the config file. You can find the config file in `config/jira.php`.

```php
<?php

declare(strict_types=1);

// config for Alibori/LaravelJiraPackage
return [
    /**
     * This is the configuration file for the Laravel Jira Package
     */
    'jira_url' => env('JIRA_URL', 'https://jira.example.com'),
    'jira_username' => env('JIRA_USERNAME', 'jira_username'),
    'jira_token' => env('JIRA_TOKEN', 'jira_token'),

    'jira_board_id' => env('JIRA_BOARD_ID', 1),
];
```

## Usage

```php
php artisan jira:info
```

![jira-1](https://user-images.githubusercontent.com/71702817/228298094-845ec0db-2501-4c19-8e18-f15d4ba15ea9.png)

![jira-2](https://user-images.githubusercontent.com/71702817/228298353-e501e771-2879-4713-81e1-c88232d29044.png)

![jira-3](https://user-images.githubusercontent.com/71702817/228298673-be569ede-6893-49f1-b50a-293f0d804a84.png)

![jira-4](https://user-images.githubusercontent.com/71702817/228298811-c7df62e9-b1ba-4a17-9e7e-c570259212dc.png)

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Security Vulnerabilities

Please review [our security policy](../../security/policy) on how to report security vulnerabilities.

## Credits

- [Axel Libori Roch](https://github.com/alibori)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
