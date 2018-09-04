<?php

namespace MNC\Countries\Country;

/**
 * Class Language
 * @package MNC\Countries\Country
 * @author Matías Navarro Carter <mnavarro@option.cl>
 */
class Language
{
    /**
     * @var string
     */
    private $iso639_1;
    /**
     * @var string
     */
    private $iso639_2;
    /**
     * @var string
     */
    private $name;
    /**
     * @var string
     */
    private $nativeName;

    public function __construct(string $iso639_1, string $iso639_2, string $name, string $nativeName)
    {
        $this->iso639_1 = $iso639_1;
        $this->iso639_2 = $iso639_2;
        $this->name = $name;
        $this->nativeName = $nativeName;
    }

    /**
     * @return string
     */
    public function getIso6391(): string
    {
        return $this->iso639_1;
    }

    /**
     * @return string
     */
    public function getIso6392(): string
    {
        return $this->iso639_2;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getNativeName(): string
    {
        return $this->nativeName;
    }
}