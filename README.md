# Laravel Jira Package

[![Latest Version on Packagist](https://img.shields.io/packagist/v/alibori/laravel-jira-package.svg?style=flat-square)](https://packagist.org/packages/alibori/laravel-jira-package)
[![run-tests](https://github.com/alibori/laravel-jira-package/actions/workflows/run-tests.yml/badge.svg)](https://github.com/alibori/laravel-jira-package/actions/workflows/run-tests.yml)
[![PHPStan](https://github.com/alibori/laravel-jira-package/actions/workflows/phpstan.yml/badge.svg)](https://github.com/alibori/laravel-jira-package/actions/workflows/phpstan.yml)
[![Total Downloads](https://img.shields.io/packagist/dt/alibori/laravel-jira-package.svg?style=flat-square)](https://packagist.org/packages/alibori/laravel-jira-package)

This package is a wrapper for the Jira API. It allows you to interact with Jira within your Laravel application.

## Installation

You can install the package via composer:

```bash
composer require alibori/laravel-jira-package
```

You can publish the config file with:

```bash
php artisan vendor:publish --tag="jira-package-config"
```

Optionally, you can publish the views using

```bash
php artisan vendor:publish --tag="jira-package-views"
```

## Usage

```php
$laravelJiraPackage = new Alibori\LaravelJiraPackage();
echo $laravelJiraPackage->echoPhrase('Hello, Alibori!');
```

## Testing

```bash
composer test
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## Security Vulnerabilities

Please review [our security policy](../../security/policy) on how to report security vulnerabilities.

## Credits

- [Axel Libori Roch](https://github.com/alibori)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
