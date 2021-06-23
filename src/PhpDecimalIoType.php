<?php

declare(strict_types=1);

namespace IDCT\Dbal\PhpDecimalIoType;

use Decimal\Decimal;
use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\Type;

class PhpDecimalIoType extends Type
{
    public const PHP_DECIMAL_IO_TYPE = 'php-decimal-io';

    public const MAX_PRECISION = 65;

    public function getSQLDeclaration(array $fieldDeclaration, AbstractPlatform $platform)
    {
        $column = ['length' => static::MAX_PRECISION + 1, 'nullable' => $fieldDeclaration['nullable'] ?? false];
        return $platform->getVarcharTypeDeclarationSQL($column);
    }

    public function convertToPHPValue($value, AbstractPlatform $platform)
    {
        return new Decimal($value);
    }

    public function convertToDatabaseValue($value, AbstractPlatform $platform)
    {
        return substr($value->toString(), 0, static::MAX_PRECISION);
    }

    public function getName()
    {
        return self::PHP_DECIMAL_IO_TYPE;
    }
}
