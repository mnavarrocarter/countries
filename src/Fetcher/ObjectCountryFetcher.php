<?php

namespace MNC\Countries\Fetcher;

use MNC\Countries\Factory\CountryFactory;

/**
 * Class ObjectCountryFetcher
 * @package MNC\Countries\Fetcher
 * @author Matías Navarro Carter <mnavarro@option.cl>
 */
class ObjectCountryFetcher extends ArrayCountryFetcher
{
    /**
     * @return array
     */
    public function fetchCountries(): array
    {
        $array = parent::fetchCountries();
        return CountryFactory::createFromCollection($array);
    }
}