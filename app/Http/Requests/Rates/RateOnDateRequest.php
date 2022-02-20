<?php

namespace App\Http\Requests\Rates;

use App\Http\Requests\JsonFormRequest;
use App\Service\Rates\Common\Dto\RequestRateOnDateDto;
use App\Service\Rates\Common\Enum\CurrencyEnum;
use App\Service\Rates\Common\Factories\RequestRateOnDateDtoFactory;
use Illuminate\Validation\Rule;

class RateOnDateRequest extends JsonFormRequest
{
    public const ATTR_CURRENCY = 'currency';
    public const ATTR_DATE     = 'date';

    /**
     * @inheritDoc
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Валидация
     */
    public function rules(): array
    {
        return [
            self::ATTR_CURRENCY => ['required', Rule::in(CurrencyEnum::cases())],
            self::ATTR_DATE     => ['required', 'date', 'date_format:Y-m-d']
        ];
    }

    /**
     * @inheritDoc
     */
    public function all($keys = null)
    {
        $data = parent::all($keys);
        $data[self::ATTR_DATE] = $this->route(self::ATTR_DATE);
        $data[self::ATTR_CURRENCY] = $this->route(self::ATTR_CURRENCY);

        return $data;
    }

    /**
     * DTO c описнаием запроса
     *
     * @return RequestRateOnDateDto
     * @throws \Exception
     */
    public function getDto(): RequestRateOnDateDto
    {
        $all = $this->all();
        return RequestRateOnDateDtoFactory::createByRawData(
            $all[self::ATTR_DATE] ?? null,
            $all[self::ATTR_CURRENCY] ?? null
        );
    }
}
