<?php

namespace App\Service\Rates\Common\Dto;

use DateTime;

/**
 * DTO с описанием запроса курса
 */
class RequestRateOnDateDto
{
    private DateTime $date;
    private string   $currency;

    public function __construct(DateTime $date, string $currency)
    {
        $this->date = $date;
        $this->currency = $currency;
    }

    /**
     * @return DateTime
     */
    public function getDate(): DateTime
    {
        return $this->date;
    }

    /**
     * @return string
     */
    public function getCurrency(): string
    {
        return $this->currency;
    }
}
