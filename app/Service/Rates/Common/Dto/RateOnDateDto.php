<?php

namespace App\Service\Rates\Common\Dto;

use DateTime;

/**
 * DTO с описанием ответа курса на день
 */
class RateOnDateDto
{
    private DateTime $date;
    private string   $currency;
    private float    $rate;

    public function __construct(DateTime $date, string $currency, float $rate)
    {

        $this->date = $date;
        $this->currency = $currency;
        $this->rate = $rate;
    }

    /**
     * Дата курса
     *
     * @return DateTime
     */
    public function getDate(): DateTime
    {
        return $this->date;
    }

    /**
     * Код валюты
     *
     * @return string
     */
    public function getCurrency(): string
    {
        return $this->currency;
    }

    /**
     * Курс
     *
     * @return float
     */
    public function getRate(): float
    {
        return $this->rate;
    }
}
