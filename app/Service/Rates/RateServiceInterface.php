<?php

namespace App\Service\Rates;

use App\Service\Rates\Common\Dto\RateOnDateDto;
use App\Service\Rates\Common\Dto\RequestRateOnDateDto;
use DateTime;

interface RateServiceInterface
{
    /**
     * Обновить курс на дату
     *
     * @param RateOnDateDto $data
     */
    public function saveOnDate(RateOnDateDto $data): void;

    /**
     * Получить курс на дату
     *
     * @param RequestRateOnDateDto $request Запрос курса
     * @return RateOnDateDto
     */
    public function getRateOnDate(RequestRateOnDateDto $request): RateOnDateDto;

    /**
     * Получить курсы валют на дату из внешнего источника
     *
     * @param DateTime $date
     * @return RateOnDateDto[]
     */
    public function getExternalRateOnDate(DateTime $date): array;
}
