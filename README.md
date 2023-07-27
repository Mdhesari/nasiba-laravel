# Very short description of the package

[![Latest Version on Packagist](https://img.shields.io/packagist/v/mdhesari/nasiba.svg?style=flat-square)](https://packagist.org/packages/mdhesari/nasiba)
[![Total Downloads](https://img.shields.io/packagist/dt/mdhesari/nasiba.svg?style=flat-square)](https://packagist.org/packages/mdhesari/nasiba)
![GitHub Actions](https://github.com/mdhesari/nasiba/actions/workflows/main.yml/badge.svg)

Nasiba decorator for laravel.

## Installation

You can install the package via composer:

```bash
composer require mdhesari/nasiba
```

## Usage

```php
app('nasiba')->getPaymentToken([
    'quantity'                  => $quantity,
            'invoiceNumber'     => $id,
            'installmentsCount' => 1,
            'maxCreditShare'    => $max_credit_share,
            'mobile'            => $mobile,
            'timestamp'         => $timestamp = today()->format('Y-m-d').'T'.now()->format('h:i:s'),
]);
```

### Testing

```bash
composer test
```

### Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

### Security

If you discover any security related issues, please email mdhesari99@gmail.com instead of using the issue tracker.

## Credits

- [Mohamad Hesari](https://github.com/mdhesari)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

## Laravel Package Boilerplate

This package was generated using the [Laravel Package Boilerplate](https://laravelpackageboilerplate.com).
