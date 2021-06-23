<?php

declare(strict_types=1);

namespace IDCT\Dbal\PhpDecimalIoType;

use Decimal\Decimal;
use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\Type;

class PhpDecimalIoType extends Type
{
    public const PHP_DECIMAL_IO_TYPE = 'php-decimal-io';

    public function getSQLDeclaration(array $fieldDeclaration, AbstractPlatform $platform)
    {
        $fixed = ($fieldDeclaration['precision'] ?? Decimal::DEFAULT_PRECISION) + 1;
        $column = ['fixed' => $fixed, 'nullable' => $fieldDeclaration['nullable'] ?? false];

        return $platform->getVarcharTypeDeclarationSQL($column);
    }

    public function convertToPHPValue($value, AbstractPlatform $platform)
    {
        return new Decimal($value);
    }

    public function convertToDatabaseValue($value, AbstractPlatform $platform)
    {
        return $value->toString();
    }

    public function getName()
    {
        return self::PHP_DECIMAL_IO_TYPE;
    }
}
