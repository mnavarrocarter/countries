<?php

namespace MNC\Countries\Tests\Fetcher;

use MNC\Countries\Country\Country;
use MNC\Countries\Fetcher\ObjectCountryFetcher;
use PHPUnit\Framework\TestCase;

class ObjectCountryFetcherTest extends TestCase
{
    public function testFetchCountries(): void
    {
        $fetcher = new ObjectCountryFetcher();
        $countries = $fetcher->fetchCountries();

        $this->assertInstanceOf(Country::class, $countries[0]);
    }
}
