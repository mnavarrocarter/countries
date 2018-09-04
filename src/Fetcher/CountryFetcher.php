<?php

namespace MNC\Countries\Fetcher;

/**
 * Interface CountryFetcher
 * @package MNC\Countries\Http
 * @author Matías Navarro Carter <mnavarro@option.cl>
 */
interface CountryFetcher
{
    /**
     * @return array
     */
    public function fetchCountries(): array;
}