<?php

namespace MNC\Countries\Country;

use MNC\Countries\Exception\CountryNotFoundException;
use MNC\Countries\Repository\CountryRepository;

/**
 * Class CountryCollection
 * @package MNC\Countries\Country
 * @author Matías Navarro Carter <mnavarro@option.cl>
 */
class CountryCollection implements \ArrayAccess, \IteratorAggregate, \Countable, CountryRepository
{
    /**
     * @var Country[]
     */
    private $countries;

    /**
     * CountryCollection constructor.
     * @param array $countries
     */
    public function __construct(array $countries)
    {
        $this->countries = $countries;
    }

    /**
     * @param mixed $offset
     * @return bool
     */
    public function offsetExists($offset): bool
    {
        return array_key_exists($offset, $this->countries);
    }

    /**
     * @param mixed $offset
     * @return Country
     */
    public function offsetGet($offset): Country
    {
        return $this->countries[$offset];
    }

    /**
     * @param mixed $offset
     * @param mixed $value
     */
    public function offsetSet($offset, $value)
    {
        $this->countries[$offset] = $value;
    }

    /**
     * @param mixed $offset
     */
    public function offsetUnset($offset)
    {
        unset($this->countries[$offset]);
    }

    /**
     * @return \Traversable
     */
    public function getIterator(): \Traversable
    {
        return new \ArrayIterator($this->countries);
    }

    /**
     * @return int
     */
    public function count(): int
    {
        return \count($this->countries);
    }

    /**
     * Adds a Country to the repository.
     * @param Country $country
     */
    public function add(Country $country): void
    {
        $this->countries[] = $country;
    }

    /**
     * Returns all the countries.
     * @return CountryCollection
     */
    public function all(): CountryCollection
    {
        return clone $this;
    }

    /**
     * Searches the countries by a partial name.
     * @param string $name
     * @return CountryCollection
     */
    public function byName(string $name): CountryCollection
    {
        // By name, nativeName and altSpellings
        $array = array_filter($this->countries, function (Country $country) use ($name) {
            if (preg_match('/'.$name.'/', $country->getName()) === 1) {
                return true;
            }
            if (preg_match('/'.$name.'/', $country->getNativeName()) === 1) {
                return true;
            }
            foreach ($country->getAltSpellings() as $spelling) {
                if (preg_match('/'.$name.'/', $spelling) === 1) {
                    return true;
                }
            }
            return false;
        });
        return new CountryCollection($array);
    }

    /**
     * Searches the countries by full name.
     * @param string $fullName
     * @return CountryCollection
     */
    public function byFullName(string $fullName): CountryCollection
    {
        // By name, nativeName and altSpellings
        $array = array_filter($this->countries, function (Country $country) use ($fullName) {
            if ($country->getName() === $fullName) {
                return true;
            }
            if ($country->getNativeName() === $fullName) {
                return true;
            }
            foreach ($country->getAltSpellings() as $spelling) {
                if ($spelling === $fullName) {
                    return true;
                }
            }

            return false;
        });
        return new CountryCollection($array);
    }

    /**
     * Searches the countries by two letter or three letter country code.
     * @param string $isoCode
     * @return Country
     * @throws CountryNotFoundException
     */
    public function byCode(string $isoCode): Country
    {
        foreach ($this->countries as $country) {
            if ($country->getAlpha2Code() === $isoCode || $country->getAlpha3Code() === $isoCode) {
                return $country;
            }
        }
        throw CountryNotFoundException::countryCode($isoCode);
    }

    /**
     * Searches the countries by a collection of iso codes.
     * @param array $isoCodes
     * @return mixed
     */
    public function byListOfCodes(array $isoCodes): CountryCollection
    {
        $array = array_filter($this->countries, function (Country $country) use ($isoCodes) {
            foreach ($isoCodes as $code) {
                if ($code === $country->getAlpha2Code() || $code === $country->getAlpha3Code()) {
                    return true;
                }
            }
            return false;
        });
        return new CountryCollection($array);
    }

    /**
     * Searches the countries by currency code.
     * @param string $currencyCode
     * @return CountryCollection
     */
    public function byCurrencyCode(string $currencyCode): CountryCollection
    {
        $array = array_filter($this->countries, function (Country $country) use ($currencyCode) {
            foreach ($country->getCurrencies() as $currency) {
                if ($currency->getCode() === $currencyCode) {
                    return true;
                }
            }
            return false;
        });
        return new CountryCollection($array);
    }

    /**
     * Searches the countries by the language code.
     * @param string $languageCode
     * @return CountryCollection
     */
    public function byLanguageCode(string $languageCode): CountryCollection
    {
        $array = array_filter($this->countries, function (Country $country) use ($languageCode) {
            foreach ($country->getLanguages() as $language) {
                if ($language->getIso6391() === $languageCode || $language->getIso6392() === $languageCode) {
                    return true;
                }
            }
            return false;
        });
        return new CountryCollection($array);
    }

    /**
     * Searches the countries by capital city.
     * @param string $capitalCity
     * @return CountryCollection
     */
    public function byCapitalCity(string $capitalCity): CountryCollection
    {
        $array = array_filter($this->countries, function (Country $country) use ($capitalCity) {
            if (preg_match('/'.$capitalCity.'/', $country->getCapital()) === 1) {
                return true;
            }
            return false;
        });
        return new CountryCollection($array);
    }

    /**
     * @param string $callingCode
     * @return CountryCollection
     */
    public function byCallingCode(string $callingCode): CountryCollection
    {
        $array = array_filter($this->countries, function (Country $country) use ($callingCode) {
            foreach ($country->getCallingCodes() as $code) {
                if ($callingCode === $code) {
                    return true;
                }
            }
            return false;
        });
        return new CountryCollection($array);
    }

    /**
     * @param string $region
     * @return CountryCollection
     */
    public function byRegion(string $region): CountryCollection
    {
        $array = array_filter($this->countries, function (Country $country) use ($region) {
            return $country->getRegion() === $region || $country->getSubregion() === $region;
        });
        return new CountryCollection($array);
    }

    /**
     * @param string $regionalBloc
     * @return CountryCollection
     */
    public function byRegionalBloc(string $regionalBloc): CountryCollection
    {
        $array = array_filter($this->countries, function (Country $country) use ($regionalBloc) {
            foreach ($country->getRegionalBlocs() as $bloc) {
               if ($bloc->getAcronym() === $regionalBloc) {
                   return true;
               }
            }
            return false;
        });
        return new CountryCollection($array);
    }

    /**
     * @return bool
     */
    public function isEmpty(): bool
    {
        return $this->count() === 0;
    }
}