<?php

namespace App\Service\Rates\External\Repository;

use App\Service\Rates\Common\Enum\CurrencyEnum;
use App\Service\Rates\Common\Factories\RateOnDateDtoFactory;
use App\Service\Rates\External\Enums\CurrencyCbrEnum;
use DateTime;
use Psr\Http\Message\StreamInterface;

/**
 * Получение данных от банка Россия
 */
class InfoCbrRepository implements ExternalRepositoryInterface
{

    /**
     * @inheritDoc
     */
    public function getRatesOnDate(DateTime $date): array
    {
        $result = [];

        // Коды ЦБ РФ. Ключем является ID ЦБ => значение имя константы
        $currencyCbr = array_flip(CurrencyCbrEnum::cases());
        $currency = CurrencyEnum::cases();
        $countCurrency = count($currency);

        $xmlString = $this->readFromServer($date)->getContents();
        $xml = simplexml_load_string($xmlString);

        /** @var \SimpleXMLElement $valute */
        foreach ($xml->Valute as $valute) {
            $currencyCbrId = (string)$valute->attributes()->ID;

            // берем только ту валюту которая нас интересует
            if ($currencyKey = $currencyCbr[$currencyCbrId] ?? null) {
                $currencyId = $currency[$currencyKey];
                $value = (float)str_replace(',', '.', $valute->Value);
                $result[] = RateOnDateDtoFactory::create($date, $currencyId, $value);

                if (count($result) === $countCurrency) {
                    break;
                }
            }
        }

        return $result;
    }

    /**
     * Запросили данные с сервера
     *
     * @param DateTime $date
     * @return StreamInterface
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    private function readFromServer(DateTime $date): StreamInterface
    {
        $dateContent = $date->format('d/m/Y');
        $client = new \GuzzleHttp\Client();
        $date = $client->get('http://www.cbr.ru/scripts/XML_daily.asp?date_req=' . $dateContent);
        return $date->getBody();
    }
}
