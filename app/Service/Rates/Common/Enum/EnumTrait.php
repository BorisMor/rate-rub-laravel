<?php

namespace App\Service\Rates\Common\Enum;

use ReflectionClass;

/**
 * Трейт для enums
 */
trait EnumTrait
{
    /**
     * Сисок значений
     *
     * @return array
     */
    public static function cases(): array
    {
        static $result;

        if (is_null($result)) {
            $classReflection = new ReflectionClass(static::class);
            $result = $classReflection->getConstants();
        }

        return $result;
    }
}
