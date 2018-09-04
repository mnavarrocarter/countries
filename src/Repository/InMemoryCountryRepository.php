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
     * @var CountryFetcher
     */
    private $countryFetcher;

    /**
     * @var CountryCollection
     */
    private $countries ;

    /**
     * InMemoryCountryRepository constructor.
     * @param CountryFetcher $countryFetcher
     */
    public function __construct(CountryFetcher $countryFetcher)
    {
        $this->countryFetcher = $countryFetcher;
    }

    public function all(): CountryCollection
    {
        $this->ensureCountriesAreInMemory();
        return $this->countries->all();
    }

    public function byName(string $name): CountryCollection
    {
        $this->ensureCountriesAreInMemory();
        return $this->countries->byName($name);
    }

    public function byFullName(string $fullName): CountryCollection
    {
        $this->ensureCountriesAreInMemory();
        return $this->countries->byFullName($fullName);
    }

    public function byCode(string $isoCode): Country
    {
        $this->ensureCountriesAreInMemory();
        return $this->countries->byCode($isoCode);
    }

    public function byListOfCodes(array $isoCodes): CountryCollection
    {
        $this->ensureCountriesAreInMemory();
        return $this->countries->byListOfCodes($isoCodes);
    }

    public function byCurrencyCode(string $currencyCode): CountryCollection
    {
        $this->ensureCountriesAreInMemory();
        return $this->countries->byCurrencyCode($currencyCode);
    }

    public function byLanguageCode(string $languageCode): CountryCollection
    {
        $this->ensureCountriesAreInMemory();
        return $this->countries->byLanguageCode($languageCode);
    }

    public function byCapitalCity(string $capitalCity): CountryCollection
    {
        $this->ensureCountriesAreInMemory();
        return $this->countries->byCapitalCity($capitalCity);
    }

    public function byCallingCode(string $callingCode): CountryCollection
    {
        $this->ensureCountriesAreInMemory();
        return $this->countries->byCallingCode($callingCode);
    }

    public function byRegion(string $region): CountryCollection
    {
        $this->ensureCountriesAreInMemory();
        return $this->countries->byRegion($region);
    }

    public function byRegionalBloc(string $regionalBlock): CountryCollection
    {
        $this->ensureCountriesAreInMemory();
        return $this->countries->byRegionalBloc($regionalBlock);
    }

    private function ensureCountriesAreInMemory(): void
    {
        if ($this->countries === null) {
            $this->countries = new CountryCollection($this->countryFetcher->fetchCountries());
        }
    }
}