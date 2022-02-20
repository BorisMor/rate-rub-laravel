<?php

namespace App\Service\Rates\Common\Factories;

use App\Service\Rates\Common\Dto\RequestRateOnDateDto;
use App\Service\Rates\Common\Enum\CurrencyEnum;
use DateTime;

/**
 * Фабрика {@see RequestRateOnDateDto}
 */
class RequestRateOnDateDtoFactory
{
    /**
     * @param DateTime $date Дата
     * @param string $currency Код валютсы {@see CurrencyEnum}
     * @return RequestRateOnDateDto
     */
    public static function create(DateTime $date, string $currency): RequestRateOnDateDto
    {
        return new RequestRateOnDateDto($date, $currency);
    }

    /**
     * На основе "сырых" данных
     *
     * @param string|null $rawDate
     * @param string|null $rawCurrency
     *
     * @return RequestRateOnDateDto
     * @throws \Exception
     */
    public static function createByRawData(?string $rawDate, ?string $rawCurrency): RequestRateOnDateDto
    {
        $date = $rawDate ? new DateTime($rawDate) : new DateTime();
        $currency = $rawCurrency ?: CurrencyEnum::USD;

        return static::create($date, $currency);
    }

}
