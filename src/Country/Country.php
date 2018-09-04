<?php

namespace MNC\Countries\Country;

/**
 * Class Country
 * @package MNC\Countries\Country
 * @author Matías Navarro Carter <mnavarro@option.cl>
 */
class Country
{
    /**
     * @var string
     */
    private $name;
    /**
     * @var array
     */
    private $topLevelDomain;
    /**
     * @var string
     */
    private $alpha2Code;
    /**
     * @var string
     */
    private $alpha3Code;
    /**
     * @var array|string[]
     */
    private $callingCodes;
    /**
     * @var string
     */
    private $capital;
    /**
     * @var array|string[]
     */
    private $altSpellings;
    /**
     * @var string
     */
    private $region;
    /**
     * @var string
     */
    private $subregion;
    /**
     * @var int
     */
    private $population;
    /**
     * @var array|int[]
     */
    private $latlng;
    /**
     * @var string
     */
    private $demonym;
    /**
     * @var int
     */
    private $area;
    /**
     * @var float
     */
    private $gini;
    /**
     * @var array|string
     */
    private $timezones;
    /**
     * @var array|string[]
     */
    private $borders;
    /**
     * @var string
     */
    private $nativeName;
    /**
     * @var string
     */
    private $numericCode;
    /**
     * @var array|Currency[]
     */
    private $currencies;
    /**
     * @var array|Language[]
     */
    private $languages;
    /**
     * @var Translations
     */
    private $translations;
    /**
     * @var string
     */
    private $flag;
    /**
     * @var array|RegionalBloc[]
     */
    private $regionalBlocs;
    /**
     * @var string
     */
    private $cioc;

    public function __construct(
        string $name,
        array $topLevelDomain,
        string $alpha2Code,
        string $alpha3Code,
        array $callingCodes,
        string $capital,
        array $altSpellings,
        string $region,
        string $subregion,
        int $population,
        array $latlng,
        string $demonym,
        int $area,
        float $gini,
        array $timezones,
        array $borders,
        string $nativeName,
        string $numericCode,
        array $currencies,
        array $languages,
        Translations $translations,
        string $flag,
        array $regionalBlocs,
        string $cioc
    ) {
        $this->name = $name;
        $this->topLevelDomain = $topLevelDomain;
        $this->alpha2Code = $alpha2Code;
        $this->alpha3Code = $alpha3Code;
        $this->callingCodes = $callingCodes;
        $this->capital = $capital;
        $this->altSpellings = $altSpellings;
        $this->region = $region;
        $this->subregion = $subregion;
        $this->population = $population;
        $this->latlng = $latlng;
        $this->demonym = $demonym;
        $this->area = $area;
        $this->gini = $gini;
        $this->timezones = $timezones;
        $this->borders = $borders;
        $this->nativeName = $nativeName;
        $this->numericCode = $numericCode;
        $this->currencies = $currencies;
        $this->languages = $languages;
        $this->translations = $translations;
        $this->flag = $flag;
        $this->regionalBlocs = $regionalBlocs;
        $this->cioc = $cioc;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return array
     */
    public function getTopLevelDomain(): array
    {
        return $this->topLevelDomain;
    }

    /**
     * @return string
     */
    public function getAlpha2Code(): string
    {
        return $this->alpha2Code;
    }

    /**
     * @return string
     */
    public function getAlpha3Code(): string
    {
        return $this->alpha3Code;
    }

    /**
     * @return array|string[]
     */
    public function getCallingCodes()
    {
        return $this->callingCodes;
    }

    /**
     * @return string
     */
    public function getCapital(): string
    {
        return $this->capital;
    }

    /**
     * @return array|string[]
     */
    public function getAltSpellings()
    {
        return $this->altSpellings;
    }

    /**
     * @return string
     */
    public function getRegion(): string
    {
        return $this->region;
    }

    /**
     * @return string
     */
    public function getSubregion(): string
    {
        return $this->subregion;
    }

    /**
     * @return int
     */
    public function getPopulation(): int
    {
        return $this->population;
    }

    /**
     * @return array|int[]
     */
    public function getLatlng()
    {
        return $this->latlng;
    }

    /**
     * @return string
     */
    public function getDemonym(): string
    {
        return $this->demonym;
    }

    /**
     * @return int
     */
    public function getArea(): int
    {
        return $this->area;
    }

    /**
     * @return float
     */
    public function getGini(): float
    {
        return $this->gini;
    }

    /**
     * @return array|string
     */
    public function getTimezones()
    {
        return $this->timezones;
    }

    /**
     * @return array|string[]
     */
    public function getBorders()
    {
        return $this->borders;
    }

    /**
     * @return string
     */
    public function getNativeName(): string
    {
        return $this->nativeName;
    }

    /**
     * @return string
     */
    public function getNumericCode(): string
    {
        return $this->numericCode;
    }

    /**
     * @return array|Currency[]
     */
    public function getCurrencies()
    {
        return $this->currencies;
    }

    /**
     * @return array|Language[]
     */
    public function getLanguages()
    {
        return $this->languages;
    }

    /**
     * @return Translations
     */
    public function getTranslations(): Translations
    {
        return $this->translations;
    }

    /**
     * @return string
     */
    public function getFlag(): string
    {
        return $this->flag;
    }

    /**
     * @return array|RegionalBloc[]
     */
    public function getRegionalBlocs()
    {
        return $this->regionalBlocs;
    }

    /**
     * @return string
     */
    public function getCioc(): string
    {
        return $this->cioc;
    }
}