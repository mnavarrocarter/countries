<?php

namespace MNC\Countries\Repository;

use MNC\Countries\Country\Country;
use MNC\Countries\Country\CountryCollection;
use MNC\Countries\Exception\CountryNotFoundException;

/**
 * Class CountryRepository
 * @package MNC\Countries\Repository
 * @author Matías Navarro Carter <mnavarro@option.cl>
 */
interface CountryRepository
{
    /**
     * Returns all the countries.
     * @return CountryCollection
     */
    public function all(): CountryCollection;

    /**
     * Searches the countries by a partial name.
     * @param string $name
     * @return CountryCollection
     */
    public function byName(string $name): CountryCollection;

    /**
     * Searches the countries by full name.
     * @param string $fullName
     * @return CountryCollection
     */
    public function byFullName(string $fullName): CountryCollection;

    /**
     * Searches one country by two letter or three letter country code.
     * @param string $isoCode
     * @return Country
     *
     * @throws CountryNotFoundException
     */
    public function byCode(string $isoCode): Country;

    /**
     * Searches the countries by a collection of iso codes.
     * @param array $isoCodes
     * @return mixed
     */
    public function byListOfCodes(array $isoCodes): CountryCollection;

    /**
     * Searches the countries by currency code.
     * @param string $currencyCode
     * @return CountryCollection
     */
    public function byCurrencyCode(string $currencyCode): CountryCollection;

    /**
     * Searches the countries by the language code.
     * @param string $languageCode
     * @return CountryCollection
     */
    public function byLanguageCode(string $languageCode): CountryCollection;

    /**
     * Searches the countries by capital city.
     * @param string $capitalCity
     * @return CountryCollection
     */
    public function byCapitalCity(string $capitalCity): CountryCollection;

    /**
     * @param string $callingCode
     * @return CountryCollection
     */
    public function byCallingCode(string $callingCode): CountryCollection;

    /**
     * @param string $region
     * @return CountryCollection
     */
    public function byRegion(string $region): CountryCollection;

    /**
     * @param string $regionalBloc
     * @return CountryCollection
     */
    public function byRegionalBloc(string $regionalBloc): CountryCollection;
}