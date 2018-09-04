<?php

namespace MNC\Countries\Fetcher;

/**
 * Class CountryFetcher
 * @package MNC\Countries\Http
 * @author Matías Navarro Carter <mnavarro@option.cl>
 */
class ArrayCountryFetcher implements CountryFetcher
{
    /**
     * @return array
     */
    public function fetchCountries(): array
    {
        $json = file_get_contents('https://restcountries.eu/rest/v2/all');
        return json_decode($json, true);
    }
}