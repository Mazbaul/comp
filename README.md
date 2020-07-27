# composite_unique Validator Rule For Laravel


This package contains composite key validation rule for Laravel, that allows for validation of multi-column UNIQUE indexes.

## Installation

Install the package through [Composer](http://getcomposer.org).
On the command line:

```
composer require mazbaul/comp
```

## Configuration

Add the following to your `providers` array in `config/app.php`:

```php
'providers' => [
    // ...

    Mazbaul\Comp\CompServiceProvider::class,
],
```

## Usage

Use it like any `Validator` rule:

```php

$validator = Validator::make($request->all(), [
      
      "<field1>" =>'required|composite_unique:<table>,<field1>,<field2>',
    ]);
```

See the [Validation documentation](http://laravel.com/docs/validation) of Laravel.



### Ignore existing row (useful when updating)

You can also specify a row id to ignore (useful to solve unique constraint when updating)

This will ignore row with id 2

```php

$validator = Validator::make($request->all(), [
      
      "<field1>" =>'required|composite_unique:<table>,<field1>,<field2>,ignore-primaryKey-'.$id,
    ]);
```

# License

MIT
