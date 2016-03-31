![moretisan](https://cloud.githubusercontent.com/assets/11269635/13992937/51d9dc9c-f11e-11e5-8009-4ea275193d6d.jpg)

# Moretisan

[![Latest Version on Packagist][ico-version]][link-packagist]
[![Total Downloads][ico-downloads]][link-downloads]
[![Software License][ico-license]](LICENSE.md)
[![Build Status][ico-travis]][link-travis]
[![Code Climate][ico-codeclimate]][link-codeclimate]
[![Code Quality][ico-quality]][link-quality]
[![SensioLabs Insight][ico-insight]][link-insight]

This package adds helpful artisan commands to your Laravel projects. More are
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
    "require": {
        "sven/moretisan": "^2.0"
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

Currently, the package provides the following command(s):

- `php artisan make:view`
- `php artisan scrap:view`

**More in-depth documentation can be found on the [wiki](../../wiki).**

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
[ico-codeclimate]: https://img.shields.io/codeclimate/github/svenluijten/moretisan.svg?style=flat-square
[ico-quality]: https://img.shields.io/scrutinizer/g/svenluijten/moretisan.svg?style=flat-square
[ico-insight]: https://img.shields.io/sensiolabs/i/533b9be4-df91-4038-b845-828222480329.svg?style=flat-square

[link-packagist]: https://packagist.org/packages/sven/moretisan
[link-downloads]: https://packagist.org/packages/sven/moretisan
[link-travis]: https://travis-ci.org/svenluijten/moretisan
[link-codeclimate]: https://codeclimate.com/github/svenluijten/moretisan
[link-quality]: https://scrutinizer-ci.com/g/svenluijten/moretisan/?branch=master
[link-insight]: https://insight.sensiolabs.com/projects/533b9be4-df91-4038-b845-828222480329
