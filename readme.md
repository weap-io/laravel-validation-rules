# laravel-validation-rules
A set of useful validation rules that can be used in your Laravel application.


# Installation
Install the package:
```bash
composer require weap-io/laravel-validation-rules
```

## Network
### Hostname
Validate a hostname.
```php
use Weap\LaravelValidationRules\Rules\Network\Hostname;

// Given input must be a valid hostname (with or without TLD)
return [
    'host' => ['required', new Hostname()],
]

// Given input must be a valid hostname without TLD
return [
    'host' => ['required', new Hostname(false)],
]
```