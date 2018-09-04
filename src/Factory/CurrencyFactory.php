<?php

namespace MNC\Countries\Factory;

use MNC\Countries\Country\Currency;

/**
 * Class CurrencyFactory
 * @package MNC\Countries\Factory
 * @author Matías Navarro Carter <mnavarro@option.cl>
 */
class CurrencyFactory
{
    /**
     * @param array $entries
     * @return array|Currency[]
     */
    public static function createFromCollection(array $entries): array
    {
        $currencies = [];
        foreach ($entries as $entry) {
            if ($entry['code'] === null) {
                continue;
            }
            $currencies[] = self::createFromEntry($entry);
        }
        return $currencies;
    }

    /**
     * @param array $entry
     * @return Currency
     */
    public static function createFromEntry(array $entry): Currency
    {
        return new Currency(
            $entry['code'],
            $entry['name'] ?? '',
            $entry['symbol'] ?? ''
        );
    }
}