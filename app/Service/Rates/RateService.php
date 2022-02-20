<?php

namespace App\Service\Rates;

use App\Service\Rates\Common\Dto\RateOnDateDto;
use App\Service\Rates\Common\Dto\RequestRateOnDateDto;
use App\Service\Rates\Common\Factories\RateOnDateDtoFactory;
use App\Service\Rates\Common\Repository\RateStoreRepositoryInterface;
use App\Service\Rates\External\Repository\ExternalRepositoryInterface;
use DateTime;

/**
 * Сервис отвечающий за работу с курсов валют
 */
class RateService implements RateServiceInterface
{
    private RateStoreRepositoryInterface $internalRepository;
    private ExternalRepositoryInterface  $externalRepository;

    public function __construct(RateStoreRepositoryInterface $internalRepository, ExternalRepositoryInterface $externalRepository)
    {
        $this->internalRepository = $internalRepository;
        $this->externalRepository = $externalRepository;
    }

    /**
     * @inheritDoc
     */
    public function getRateOnDate(RequestRateOnDateDto $request): RateOnDateDto
    {
        $rate = $this->internalRepository->getOnDate($request);

        return RateOnDateDtoFactory::createByRequest($request, $rate);
    }

    /**
     * @inheritDoc
     */
    public function saveOnDate(RateOnDateDto $data): void
    {
        $this->internalRepository->saveOnDate($data);
    }

    /**
     * @inheritDoc
     */
    public function getExternalRateOnDate(DateTime $date): array
    {
        return $this->externalRepository->getRatesOnDate($date);
    }
}
