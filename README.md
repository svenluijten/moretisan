![moretisan](https://cloud.githubusercontent.com/assets/11269635/13992937/51d9dc9c-f11e-11e5-8009-4ea275193d6d.jpg)

# Moretisan

[![Latest Version on Packagist][ico-version]][link-packagist]
[![Total Downloads][ico-downloads]][link-downloads]
[![Software License][ico-license]](LICENSE.md)
[![Build Status][ico-travis]][link-travis]

This package adds helpful artisan commands to your Laravel installation. More are
constantly being added!

## Installation
Via [composer](http://getcomposer.org):

```bash
$ composer require sven/moretisan
```

Alternatively, add the package to your dev dependencies in `composer.json` and run
`composer update` afterwards:

```json
{
    "require-dev": {
        "sven/moretisan": "*"
    }
}
```

Next, add the `MoretisanServiceProvider` to your `providers` array in `config/app.php`:

```php
// config/app.php
'providers' => [
    ...
    Sven\Moretisan\MoretisanServiceProvider::class,
    ...
];
```

## Usage
The commands in this package should now be registered. Simply run `php artisan`,
and you will see all commands in the list.

### make:view

```bash
$ php artisan make:view {name} [--extends] [--sections] [--directory=resources/views/] [--extension=.blade.php]
```

Run this command to create a new view. The name can contain periods (`.`) to dictate
the folder structure. For instance, `php artisan make:view pages.index` would create
a folder `resources/views/pages/`, and places the `index.blade.php` view in there.

Use the `--extends` option to extend a view. For example, `php artisan make:view index --extends=app`
would create a view (at `resources/views/index.blade.php`) that looks like this:

```blade
@extends('app')
```

The `--sections` option can be used to define sections in your blade template.
`php artisan make:view index --sections=content,scripts` generates the following
file at `resources/views/index.blade.php`:

```blade
@section('content')

@endsection

@section('scripts')

@endsection
```

Lastly, the `--directory` and `--extension` options can be used to override defaults.
I'll assume you get the basic idea on how those work. ;)

## Contributing
All contributions (in the form on pull requests, issues and feature-requests) are
welcomed and will be properly credited.

## License
`sven/moretisan` is licenced under the MIT License (MIT). Please see the
[license file](LICENSE.md) for more information.

[ico-version]: https://img.shields.io/packagist/v/sven/moretisan.svg?style=flat-square
[ico-license]: https://img.shields.io/badge/license-MIT-green.svg?style=flat-square
[ico-downloads]: https://img.shields.io/packagist/dt/sven/moretisan.svg?style=flat-square
[ico-travis]: https://img.shields.io/travis/svenluijten/moretisan.svg?style=flat-square

[link-packagist]: https://packagist.org/packages/sven/moretisan
[link-downloads]: https://packagist.org/packages/sven/moretisan
[link-travis]: https://travis-ci.org/svenluijten/moretisan