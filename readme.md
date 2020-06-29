# laravel-validation-rules
A set of useful Laravel validation rules created by [Weap.io](https://weap.io).


# Installation
Install the package:
```bash
composer require weap-io/laravel-validation-rules
```

## Services/Aws
### S3 Bucket name
Validate an S3 Bucket name
```php
use Weap\LaravelValidationRules\Rules\Services\Aws\S3BucketName;

return [
    'bucket_name' => ['required', new S3BucketName()],
];
```

## Network
### Hostname
Validate a hostname.
```php
use Weap\LaravelValidationRules\Rules\Network\Hostname;

// Given input must be a valid hostname (with or without TLD)
return [
    'host' => ['required', new Hostname()]
]

// Given input must be a valid hostname without TLD
return [
    'host' => ['required', new Hostname($withTld = false)]
]
```

### Port
Validate a port number.
```php
use Weap\LaravelValidationRules\Rules\Network\Port;

// The input must be a valid port number (0 excluded)
return [
    'port' => ['required', new Port()]
];

// The input must be a valid port number (0 included)
return [
    'port' => ['required', new Port($allowZero = true)]
];
```