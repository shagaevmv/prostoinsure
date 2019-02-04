<?php

namespace app\repositories;

use app\dto\CurrencyDTO;
use app\repositories\contracts\SourceCurrencyRepository;
use app\repositories\exceptions\EntityNotFoundException;
use SimpleXMLElement;

class CbrXMLSourceCurrencyRepository implements SourceCurrencyRepository
{
    const URL = 'http://www.cbr.ru/scripts/XML_daily.asp';

    /**
     * @return CurrencyDTO[]
     */
    public function getAll(): array
    {
        $result = [];

        $xmlString = file_get_contents(self::URL);

        if ($xmlString === false) {
            throw new EntityNotFoundException('CbrXMLSourceCurrencyRepository::getAll - don\'t get xml data');
        }

        $xml = new SimpleXMLElement($xmlString);

        foreach ($xml->Valute as $item) {
            $currencyDTO = new CurrencyDTO();

            $currencyDTO->id = (int) $item->NumCode;
            $currencyDTO->name = (string) $item->Name;
            $currencyDTO->rate = (float) str_replace(',', '.', $item->Value);

            $result[] = $currencyDTO;
        }

        return $result;
    }
}
