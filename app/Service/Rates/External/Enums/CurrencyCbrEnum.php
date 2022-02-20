<?php

namespace App\Service\Rates\External\Enums;

use App\Service\Rates\Common\Enum\EnumTrait;

/**
 * ID валют в банке России
 * Имена констант должны быть одинаковые с {@see CurrencyEnum}
 */
class CurrencyCbrEnum
{
    use EnumTrait;

    public const USD = 'R01235';
    public const EUR = 'R01239';
}
