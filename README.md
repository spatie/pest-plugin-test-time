
[<img src="https://github-ads.s3.eu-central-1.amazonaws.com/support-ukraine.svg?t=1" />](https://supportukrainenow.org)

# A Pest plugin to control the flow of time

[![Latest Version on Packagist](https://img.shields.io/packagist/v/spatie/pest-plugin-test-time.svg?style=flat-square)](https://packagist.org/packages/spatie/pest-plugin-test-time)
[![Tests](https://github.com/spatie/pest-plugin-test-time/actions/workflows/run-tests.yml/badge.svg)](https://github.com/spatie/pest-plugin-test-time/actions/workflows/run-tests.yml)
[![GitHub Code Style Action Status](https://img.shields.io/github/workflow/status/spatie/pest-plugin-test-time/Check%20&%20fix%20styling?label=code%20style)](https://github.com/spatie/pest-plugin-test-time/actions?query=workflow%3A"Check+%26+fix+styling"+branch%3Amaster)
[![Total Downloads](https://img.shields.io/packagist/dt/spatie/pest-plugin-test-time.svg?style=flat-square)](https://packagist.org/packages/spatie/pest-plugin-test-time)

This [Pest](https://pestphp.com) plugin offers a function `testTime` that allows you to freeze and manipulate the current time in your tests.

```php
use function Spatie\PestPluginTestTime\testTime;

testTime()->freeze(); // time will not change anymore

testTime()->addMinute(); // move time forward one minute
```

It also contains a custom expectation called `toBeCarbon` to easily check the values of `Carbon` instances.

```php
$carbon = Carbon::createFromFormat('Y-m-d H:i:s', '2022-05-31 01:02:03');

// make an expectation on the whole date, including time
expect($carbon)->toBeCarbon('2022-05-31 01:02:03');

// make an expectation on only the date part
expect($carbon)->toBeCarbon('2022-05-31');

// explicitly pass in a format
expect($carbon)->toBeCarbon('2022', 'Y');
```

## Support us

[<img src="https://github-ads.s3.eu-central-1.amazonaws.com/pest-plugin-test-time.jpg?t=1" width="419px" />](https://spatie.be/github-ad-click/pest-plugin-test-time)

We invest a lot of resources into creating [best in class open source packages](https://spatie.be/open-source). You can support us by [buying one of our paid products](https://spatie.be/open-source/support-us).

We highly appreciate you sending us a postcard from your hometown, mentioning which of our package(s) you are using. You'll find our address on [our contact page](https://spatie.be/about-us). We publish all received postcards on [our virtual postcard wall](https://spatie.be/open-source/postcards).

## Requirements

This package is a wrapper around [Carbon](https://carbon.nesbot.com/docs/)'s `setTestNow()` function. Therefore, you can only use this Pest plugin only in projects that use Carbon.

## Installation

You can install the package via composer:

```bash
composer require spatie/pest-plugin-test-time
```

## Usage

You can call `freeze` on the `testTime` function to freeze the current time.

```php
use Carbon\Carbon;
use function Spatie\PestPluginTestTime\testTime;

testTime()->freeze(); // the current time will not change anymore

Carbon::now(); // returns the time

sleep(2);

Carbon::now(); // will return the same time as above
```

### Freezing at a specific point in time

You can also freeze the time at a specific point by passing the time in format `Y-m-d H:i:s`.

```php
testTime()->freeze('2021-01-02 12:34:56');

\Carbon\Carbon::now()->format('Y-m-d H:i:s') // returns '2021-01-02 12:34:56';
```

## Changing the time

You can change the time, by calling any of the `add` and `sub` functions that are available on `Carbon`.

```php
testTime()->freeze('2021-01-02 12:34:56');

testTime()->addHour(); // time is now at '2021-01-02 13:34:56'

// you can even chain method calls
testTime()->subMinute()->addSeconds(2); // time is now at '2021-01-02 13:33:58'
```

### Expecting a carbon value

This package offers a custom expectation called `toBeCarbon` to easily check the value of a `Carbon` instance.

```php
$carbon = Carbon::createFromFormat('Y-m-d H:i:s', '2022-05-31 01:02:03');

// make an expectation on the whole date, including time
expect($carbon)->toBeCarbon('2022-05-31 01:02:03');

// make an expectation on only the date part
expect($carbon)->toBeCarbon('2022-05-31');

// explicitly pass in a format
expect($carbon)->toBeCarbon('2022', 'Y');
```

## Testing

```bash
composer test
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](https://github.com/spatie/.github/blob/main/CONTRIBUTING.md) for details.

## Security Vulnerabilities

Please review [our security policy](../../security/policy) on how to report security vulnerabilities.

## Credits

- [Freek Van der Herten](https://github.com/freekmurze)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
