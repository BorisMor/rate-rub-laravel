<?php

namespace App\Http\Controllers;

use App\Http\Requests\Rates\RateOnDateRequest;
use App\Service\Rates\RateServiceInterface;

class RateController extends Controller
{
    public const ACTION_RATE_ON_DATE = 'rateOnDate';

    private RateServiceInterface $rateService;

    public function __construct(RateServiceInterface $rateService)
    {
        $this->rateService = $rateService;
    }

    public function rateOnDate(RateOnDateRequest $request)
    {
        $resultDto = $this->rateService->getRateOnDate($request->getDto());

        return response()->json(
            [
                'status' => 200,
                'data'   => [
                    'currency' => $resultDto->getCurrency(),
                    'date'     => $resultDto->getDate()->format('Y-m-d'),
                    'rate'     => $resultDto->getRate()
                ],
            ], 200
        );
    }
}
