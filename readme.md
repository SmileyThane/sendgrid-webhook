# Sendgrid Webhook

[![Latest Version on Packagist][ico-version]][link-packagist]
[![Total Downloads][ico-downloads]][link-downloads]
[![Build Status][ico-travis]][link-travis]

This package create webhook handler for your laravel application and store it to database.
Take a look at [contributing.md](contributing.md) to see a to do list.

## Installation

Via Composer

``` bash
$ composer require smileythane/sendgrid-webhook
$ php artisan migrate
```

## Usage

1. Publish config file and configure related model and attribute for checking emails (default model: User, default attribute: 'email') 
2. Customize your webhook route
3. Copy your webhook route to sendgrid and activate it
4. Clear saved mail info via command:
   ``` php artisan sendgrid-webhook:clear {--model_id=} ```

## Change log

Please see the [changelog](changelog.md) for more information on what has changed recently.

## Testing

``` bash
$ composer test
```

## Contributing

Please see [contributing.md](contributing.md) for details and a todolist.

## Credits

- [Hleb Prakhnitski][link-author]
- [All Contributors][link-contributors]

## License

MIT. Please see the [license file](license.md) for more information.

[ico-version]: https://img.shields.io/packagist/v/smileythane/sendgrid-webhook.svg?style=flat-square
[ico-downloads]: https://img.shields.io/packagist/dt/smileythane/sendgrid-webhook.svg?style=flat-square
[ico-travis]: https://img.shields.io/travis/smileythane/sendgrid-webhook/master.svg?style=flat-square
[ico-styleci]: https://styleci.io/repos/12345678/shield

[link-packagist]: https://packagist.org/packages/smileythane/sendgrid-webhook
[link-downloads]: https://packagist.org/packages/smileythane/sendgrid-webhook
[link-travis]: https://travis-ci.org/smileythane/sendgrid-webhook
[link-author]: https://github.com/smileythane
[link-contributors]: ../../contributors
