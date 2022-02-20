<?php

namespace App\Service\Rates\Common\Repository;

use App\Service\Rates\Common\Dto\RateOnDateDto;
use App\Service\Rates\Common\Dto\RequestRateOnDateDto;

/**
 * Интерфейс для хранилища данных по курсу
 */
interface RateStoreRepositoryInterface
{
    /**
     * Запросить курс на дату
     *
     * @param RequestRateOnDateDto $request
     * @return float
     */
    public function getOnDate(RequestRateOnDateDto $request): float;

    /**
     * Записать курс на дату
     *
     * @param RateOnDateDto $data
     */
    public function saveOnDate(RateOnDateDto $data): void;
}
