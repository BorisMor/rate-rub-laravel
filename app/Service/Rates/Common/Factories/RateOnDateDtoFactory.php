<?php

namespace App\Service\Rates\Common\Factories;

use App\Service\Rates\Common\Dto\RateOnDateDto;
use App\Service\Rates\Common\Dto\RequestRateOnDateDto;
use DateTime;

/**
 * Фабрик для {@see RateOnDateDto}
 */
class RateOnDateDtoFactory
{
    /**
     * @param DateTime $date Дата
     * @param string $currency Код валюты {@see CurrencyEnum}
     * @param float $rate Курс на дату
     *
     * @return RateOnDateDto
     */
    public static function create(DateTime $date, string $currency, float $rate): RateOnDateDto
    {
        return new RateOnDateDto($date, $currency, $rate);
    }

    /**
     * Создать на основе DTO запроса {@see RequestRateOnDateDto}
     *
     * @param RequestRateOnDateDto $request
     * @param float $rate
     * @return RateOnDateDto
     */
    public static function createByRequest(RequestRateOnDateDto $request, float $rate)
    {
        return static::create(
            $request->getDate(),
            $request->getCurrency(),
            $rate
        );
    }
}
