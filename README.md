php-decimal.io Doctrine Type
============================

The missing link between Doctrine and php-decimal.io.

# Installation

You require at least PHP 8.0, decimal extension and php-decimal library (installed via composer).

To install this library just type:
```
composer require idct-tech/php-decimal-io-dbal
```

Then in your doctrine configuration be sure to set up the mapping:
https://www.doctrine-project.org/projects/doctrine-orm/en/2.9/cookbook/custom-mapping-types.html

In Symfony 4+, 5+ you can set this up in your `config/packages/doctrine.yaml`:
```
doctrine:
    dbal:
        types:
            php-decimal-io:  IDCT\Dbal\PhpDecimalIoType\PhpDecimalIoType
```
