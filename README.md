# Detect disposable emails
A PHP package to detect disposable emails based on [ivolo/disposable-email-domains](https://github.com/ivolo/disposable-email-domains) list.

## Installation
You can install this package via composer:

```bash
composer require mariomka/detect-disposable-emails
```

## How to use
```php
$emailDetector = new EmailDetector();

if($emailDetector->isDisposable('something@domain.com')) {
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
