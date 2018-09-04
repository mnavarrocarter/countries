<?php

namespace MNC\Countries\Exception;

/**
 * Class CountryNotFoundException
 * @package MNC\Countries\Exception
 */
class CountryNotFoundException extends MNCCountriesException
{
    /**
     * @param string $countryCode
     * @return CountryNotFoundException
     */
    public static function countryCode(string $countryCode): CountryNotFoundException
    {
        return new self(
            sprintf('Country with code "%s" has not been found.',$countryCode)
        );
    }
}