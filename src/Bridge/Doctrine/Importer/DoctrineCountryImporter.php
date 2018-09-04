<?php

namespace MNC\Countries\Bridge\Doctrine\Importer;

use Doctrine\Common\Persistence\ObjectManager;
use MNC\Countries\Country\Country;
use MNC\Countries\Country\Currency;
use MNC\Countries\Country\Language;
use MNC\Countries\Country\RegionalBloc;
use MNC\Countries\Country\Translations;
use MNC\Countries\Factory\CurrencyFactory;
use MNC\Countries\Factory\LanguageFactory;
use MNC\Countries\Factory\RegionalBlocFactory;
use MNC\Countries\Fetcher\ArrayCountryFetcher;

/**
 * Class DoctrineCountryImporter
 * @package MNC\Countries\Bridge\Doctrine\Importer
 * @author Matías Navarro Carter <mnavarro@option.cl>
 */
class DoctrineCountryImporter
{
    /**
     * @var ArrayCountryFetcher
     */
    private $countryFetcher;
    /**
     * @var ObjectManager
     */
    private $objectManager;

    /**
     * DoctrineCountryImporter constructor.
     * @param ObjectManager $objectManager
     */
    public function __construct(ObjectManager $objectManager)
    {
        $this->countryFetcher = new ArrayCountryFetcher();
        $this->objectManager = $objectManager;
    }

    /**
     * @param callable|null $callable
     * @return int The number of imported
     */
    public function import(callable $callable = null): int
    {
        $i = 0;
        foreach ($this->countryFetcher->fetchCountries() as $country) {
            $country = $this->createCountry($country);
            $this->objectManager->persist($country);
            $this->objectManager->flush();
            $i++;

            if ($callable !== null) {
                $callable($country, $i);
            }
        }
        return $i;
    }

    /**
     * @param array $entry
     * @return Country
     */
    private function createCountry(array $entry): Country
    {
        $currencies = [];
        $languages = [];
        $regionalBlocs = [];

        foreach ($entry['currencies'] as $currency) {
            if ($currency['code'] !== null) {
                $currencies[] = $this->saveOrFetchCurrency($currency);
            }
        }

        foreach ($entry['languages'] as $language) {
            if ($language['iso639_2'] !== null) {
                $languages[] = $this->saveOrFetchLanguage($language);
            }
        }

        foreach ($entry['regionalBlocs'] as $bloc) {
            if ($bloc['acronym'] !== null) {
                $regionalBlocs[] = $this->saveOrFetchRegionalBloc($bloc);
            }
        }

        return new Country(
            $entry['name'],
            $entry['topLevelDomain'],
            $entry['alpha2Code'],
            $entry['alpha3Code'],
            $entry['callingCodes'],
            $entry['capital'],
            $entry['altSpellings'],
            $entry['region'],
            $entry['subregion'],
            $entry['population'] ?? 0,
            $entry['latlng'],
            $entry['demonym'] ?? '',
            $entry['area'] ?? 0,
            $entry['gini'] ?? 0.0,
            $entry['timezones'],
            $entry['borders'],
            $entry['nativeName'] ?? '',
            $entry['numericCode'] ?? '',
            $currencies,
            $languages,
            Translations::fromArray($entry['translations']),
            $entry['flag'] ?? '',
            $regionalBlocs,
            $entry['cioc'] ?? ''
        );
    }

    /**
     * @param array $language
     * @return Language
     */
    private function saveOrFetchLanguage(array $language): Language
    {
        $object = $this->objectManager->find(Language::class, $language['iso639_2']);
        if (null === $object) {
            $object = LanguageFactory::createFromEntry($language);
            $this->objectManager->persist($object);
            $this->objectManager->flush();
        }
        return $object;
    }

    /**
     * @param array $regionBloc
     * @return RegionalBloc
     */
    private function saveOrFetchRegionalBloc(array $regionBloc): RegionalBloc
    {
        $object = $this->objectManager->find(RegionalBloc::class, $regionBloc['acronym']);
        if (null === $object) {
            $object = RegionalBlocFactory::createFromEntry($regionBloc);
            $this->objectManager->persist($object);
            $this->objectManager->flush();
        }
        return $object;
    }

    /**
     * @param array $currency
     * @return Currency
     */
    private function saveOrFetchCurrency(array $currency): Currency
    {
        $object = $this->objectManager->find(Currency::class, $currency['code']);
        if (null === $object) {
            $object = CurrencyFactory::createFromEntry($currency);
            $this->objectManager->persist($object);
            $this->objectManager->flush();
        }
        return $object;
    }
}