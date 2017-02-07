[![Latest Stable Version](https://poser.pugx.org/mariomka/disposable-email-detector/v/stable?format=flat-square)](https://packagist.org/packages/mariomka/disposable-email-detector)
[![License](https://poser.pugx.org/mariomka/disposable-email-detector/license?format=flat-square)](https://packagist.org/packages/mariomka/disposable-email-detector)
[![Build Status](https://travis-ci.org/mariomka/disposable-email-detector.svg?branch=master)](https://travis-ci.org/mariomka/disposable-email-detector)
[![StyleCI](https://styleci.io/repos/81080659/shield?branch=master)](https://styleci.io/repos/81080659)

# Disposable email detector
A PHP package to detect disposable emails based on [ivolo/disposable-email-domains](https://github.com/ivolo/disposable-email-domains) list.

## Installation
You can install this package via composer:

```bash
composer require mariomka/detect-disposable-emails
```

## How to use
```php
$detector = new \Mariomka\DisposableEmailDetector\Detector();

if($detector->isDisposable('something@domain.com')) {
    // Disposable email
} else {
    // Acceptable email
}
```

## Testing
You can run the tests with:

```bash
vendor/bin/phpunit
```

## License
The MIT License (MIT). Please see [License File](LICENSE.md).
