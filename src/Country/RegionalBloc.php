<?php

namespace MNC\Countries\Country;

/**
 * Class RegionalBloc
 * @package MNC\Countries\Country
 * @author Matías Navarro Carter <mnavarro@option.cl>
 */
class RegionalBloc
{
    /**
     * @var string
     */
    private $acronym;
    /**
     * @var string
     */
    private $name;
    /**
     * @var array
     */
    private $otherAcronyms;
    /**
     * @var array
     */
    private $otherNames;

    /**
     * RegionalBlock constructor.
     * @param string $acronym
     * @param string $name
     * @param array  $otherAcronyms
     * @param array  $otherNames
     */
    public function __construct(string $acronym, string $name, array $otherAcronyms, array $otherNames)
    {
        $this->acronym = $acronym;
        $this->name = $name;
        $this->otherAcronyms = $otherAcronyms;
        $this->otherNames = $otherNames;
    }

    /**
     * @return string
     */
    public function getAcronym(): string
    {
        return $this->acronym;
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
    public function getOtherAcronyms(): array
    {
        return $this->otherAcronyms;
    }

    /**
     * @return array
     */
    public function getOtherNames(): array
    {
        return $this->otherNames;
    }
}