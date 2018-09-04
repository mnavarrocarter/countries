<?php

namespace MNC\Countries\Fetcher;

use Psr\SimpleCache\CacheInterface;

/**
 * Class CacheDecoratedCountryFetcher
 * @package MNC\Countries\Http
 * @author Matías Navarro Carter <mnavarro@option.cl>
 */
class CacheCountryFetcherDecorator implements CountryFetcher
{
    public const CACHE_KEY = 'rest-countries';

    /**
     * @var CountryFetcher
     */
    private $countryFetcher;
    /**
     * @var CacheInterface
     */
    private $cache;

    /**
     * CacheableCountryFetcher constructor.
     * @param CountryFetcher $countryFetcher
     * @param CacheInterface $cache
     */
    public function __construct(CountryFetcher $countryFetcher, CacheInterface $cache)
    {
        $this->countryFetcher = $countryFetcher;
        $this->cache = $cache;
    }

    /**
     * @return array
     * @throws \Psr\SimpleCache\InvalidArgumentException
     */
    public function fetchCountries(): array
    {
        if ($this->cache->has(self::CACHE_KEY)) {
            return $this->cache->get(self::CACHE_KEY);
        }
        $data = $this->countryFetcher->fetchCountries();
        $this->cache->set(self::CACHE_KEY, $data);
        return $data;
    }
}