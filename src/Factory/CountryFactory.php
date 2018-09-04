<?php

namespace MNC\Countries\Factory;

use MNC\Countries\Country\Country;
use MNC\Countries\Country\Translations;

/**
 * Class CountryFactory
 * @package MNC\Countries\Country
 * @author Matías Navarro Carter <mnavarro@option.cl>
 */
class CountryFactory
{
    /**
     * @param array $entries
     * @return array
     */
    public static function createFromCollection(array $entries): array
    {
        $countries = [];
        foreach ($entries as $entry) {
            $countries[] = self::createFromEntry($entry);
        }
        return $countries;
    }

    /**
     * @param array $entry
     * @return Country
     */
    public static function createFromEntry(array $entry): Country
    {
        return new Country(
            $entry['name'],
            $entry['topLevelDomain'],
            $entry['alpha2Code'],
            $entry['alpha3Code'],
            $entry['callingCodes'],
            $entry['capital'],
            $entry['altSpellings'],
            $entry['region'],
            $entry['subregion'],
            $entry['population'] ?? 0,
            $entry['latlng'],
            $entry['demonym'] ?? '',
            $entry['area'] ?? 0,
            $entry['gini'] ?? 0.0,
            $entry['timezones'],
            $entry['borders'],
            $entry['nativeName'] ?? '',
            $entry['numericCode'] ?? '',
            CurrencyFactory::createFromCollection($entry['currencies']),
            LanguageFactory::createFromCollection($entry['languages']),
            Translations::fromArray($entry['translations']),
            $entry['flag'] ?? '',
            RegionalBlocFactory::createFromCollection($entry['regionalBlocs']),
            $entry['cioc'] ?? ''
        );
    }
}