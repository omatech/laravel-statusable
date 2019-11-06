# Laravel Statusable

[![Latest Version on Packagist](https://img.shields.io/packagist/v/omatech/laravel-statusable.svg?style=flat-square)](https://packagist.org/packages/omatech/laravel-statusable)
[![Total Downloads](https://img.shields.io/packagist/dt/omatech/laravel-statusable.svg?style=flat-square)](https://packagist.org/packages/omatech/laravel-statusable)

Tired of repeating the status control of your models again and again? Well, here it's already done.

## Installation

You can install the package via composer:

```bash
composer require omatech/laravel-statusable
```

## Setup

``` bash

php artisan vendor:publish --tag=laravel-statusable-publish

```

## Usage

Just use ```Statusable``` trait in your models to obtain the current status or the status history.

``` php

use Omatech\LaravelStatusable\App\Traits\Statusable;

```

To add an entry to history use the add method from ```StatusHistory``` model. Example:

``` php

StatusHistory::add('status-name', 'model-instance', 'releated-model', 'guard');

```

### Testing

``` bash
composer test
```

### Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

### Security

If you discover any security related issues, please email apons@omatech.com instead of using the issue tracker.

## Credits

- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.