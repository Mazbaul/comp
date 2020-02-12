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
$rules = [
    '<field1>' => 'composite_unique:<table>,<field2>[,<field3>,...,<ignore_rowid>]',
];
```

See the [Validation documentation](http://laravel.com/docs/validation) of Laravel.

### Specify different column names in the database

If your input field names are different from the corresponding database columns,
you can specify the column names explicitly.

e.g. your input contains a field 'last_name', but the column in your database is called 'sur_name':
```php
$rules = [
    'first_name' => 'composite_unique:users, middle_name, last_name = sur_name',
];
```

### Ignore existing row (useful when updating)

You can also specify a row id to ignore (useful to solve unique constraint when updating)

This will ignore row with id 2

```php
$rules = [
    'first_name' => "required|composite_unique:users,last_name,ignore-$id",
    'last_name' => 'required',
];
```

# License

MIT
