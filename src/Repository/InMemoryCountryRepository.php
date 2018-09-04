<?php

namespace MNC\Countries\Repository;

use MNC\Countries\Country\Country;
use MNC\Countries\Country\CountryCollection;
use MNC\Countries\Fetcher\CountryFetcher;

/**
 * Class InMemoryCountryRepository
 * @package MNC\Countries\Repository
 * @author Matías Navarro Carter <mnavarro@option.cl>
 */
class InMemoryCountryRepository implements CountryRepository
{
    /**
     * @var CountryCollection
     */
    private $countries = [];

    /**
     * @param CountryFetcher $countryFetcher
     * @return InMemoryCountryRepository
     */
    public static function createWithCountries(CountryFetcher $countryFetcher): InMemoryCountryRepository
    {
        $countriesArray = $countryFetcher->fetchCountries();

        return new self($countriesArray);
    }

    /**
     * InMemoryCountryRepository constructor.
     * @param array $countries
     */
    public function __construct(array $countries = [])
    {
        $this->countries = new CountryCollection($countries);
    }

    public function add(Country $country): void
    {
        $this->countries->add($country);
    }

    public function all(): CountryCollection
    {
        return $this->countries->all();
    }

    public function byName(string $name): CountryCollection
    {
        return $this->countries->byName($name);
    }

    public function byFullName(string $fullName): CountryCollection
    {
        return $this->countries->byFullName($fullName);
    }

    public function byCode(string $isoCode): Country
    {
        return $this->countries->byCode($isoCode);
    }

    public function byListOfCodes(array $isoCodes): CountryCollection
    {
        return $this->countries->byListOfCodes($isoCodes);
    }

    public function byCurrencyCode(string $currencyCode): CountryCollection
    {
        return $this->countries->byCurrencyCode($currencyCode);
    }

    public function byLanguageCode(string $languageCode): CountryCollection
    {
        return $this->countries->byLanguageCode($languageCode);
    }

    public function byCapitalCity(string $capitalCity): CountryCollection
    {
        return $this->countries->byCapitalCity($capitalCity);
    }

    public function byCallingCode(string $callingCode): CountryCollection
    {
        return $this->countries->byCallingCode($callingCode);
    }

    public function byRegion(string $region): CountryCollection
    {
        return $this->countries->byRegion($region);
    }

    public function byRegionalBloc(string $regionalBlock): CountryCollection
    {
        return $this->countries->byRegionalBloc($regionalBlock);
    }
}