<?php

namespace App\Service\Rates\Common\Repository;

use App\Rate;
use App\Service\Rates\Common\Dto\RateOnDateDto;
use App\Service\Rates\Common\Dto\RequestRateOnDateDto;

class RateDbRepository implements RateStoreRepositoryInterface
{
    /**
     * @inheritDoc
     */
    public function getOnDate(RequestRateOnDateDto $request): float
    {
        $model = $this->findFirst($request->getDate(), $request->getCurrency());

        return $model ? (float)$model[Rate::ATTR_VALUE] : 0;
    }

    /**
     * @inheritDoc
     */
    public function saveOnDate(RateOnDateDto $data): void
    {
        $model = $this->findFirst($data->getDate(), $data->getCurrency());

        if (!$model) {
            $model = new Rate();
        }

        $model[Rate::ATTR_CURRENCY] = $data->getCurrency();
        $model[Rate::ATTR_DATE_AT] = $data->getDate();
        $model[Rate::ATTR_VALUE] = $data->getRate();

        $model->save();
    }

    private function findFirst(\DateTime $date, string $currency)
    {
        return Rate::query()
                   ->whereDate(Rate::ATTR_DATE_AT, '=', $date)
                   ->where(Rate::ATTR_CURRENCY, '=', $currency)
                   ->first();
    }
}
