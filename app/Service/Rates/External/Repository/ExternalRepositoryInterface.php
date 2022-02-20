<?php

namespace App\Service\Rates\External\Repository;

use App\Service\Rates\Common\Dto\RateOnDateDto;
use App\Service\Rates\Common\Dto\RequestRateOnDateDto;
use DateTime;

/**
 * Получение информации о курсе из внешнего источника
 */
interface ExternalRepositoryInterface
{
    /**
     * Получть курсы на дату
     *
     * @param DateTime $date Дата на которую запросили курс
     * @return RateOnDateDto[]
     */
    public function getRatesOnDate(DateTime $date): array;
}
