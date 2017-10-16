# Artisan
[![Latest Version on Packagist][ico-version]][link-packagist]
[![Total Downloads][ico-downloads]][link-downloads]
[![Software License][ico-license]](LICENSE.md)

Additional Laravel Artisan commands that I often needed.

### Downloading
Via [composer](http://getcomposer.org):

```bash
$ composer require yappkahowe/artisan
```

### Registering the service provider
If you're using Laravel 5.5, you can skip this step. The service provider will have already been registered
thanks to auto-discovery.

Otherwise, register `YappKaHowe\Artisan\ServiceProvider::class` manually in your `config/app.php`

```php
'providers' => [
    // Other service providers...

    Yappkahowe\Artisan\ServiceProvider::class,
],
```

## Usage
If you now run `php artisan` you will see two new commands in the list:
- `db:reseed`
- `db:truncate`

## Contributing
All contributions (in the form on pull requests, issues and feature-requests) are welcome.

## License
`yappkahowe/artisan` is licenced under the MIT License (MIT). Please see the
[license file](LICENSE.md) for more information.

[ico-version]: https://img.shields.io/packagist/v/yappkahowe/artisan.svg?style=flat-square
[ico-license]: https://img.shields.io/badge/license-MIT-green.svg?style=flat-square
[ico-downloads]: https://img.shields.io/packagist/dt/yappkahowe/artisan.svg?style=flat-square

[link-packagist]: https://packagist.org/packages/yappkahowe/artisan
[link-downloads]: https://packagist.org/packages/yappkahowe/artisan