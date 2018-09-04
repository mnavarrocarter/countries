<?php

namespace MNC\Countries\Country;

/**
 * Class Translation
 * @package MNC\Countries\Country
 * @author Matías Navarro Carter <mnavarro@option.cl>
 */
class Translations
{
    /**
     * @var string
     */
    private $de;
    /**
     * @var string
     */
    private $es;
    /**
     * @var string
     */
    private $fr;
    /**
     * @var string
     */
    private $ja;
    /**
     * @var string
     */
    private $it;
    /**
     * @var string
     */
    private $br;
    /**
     * @var string
     */
    private $pt;
    /**
     * @var string
     */
    private $nl;
    /**
     * @var string
     */
    private $hr;
    /**
     * @var string
     */
    private $fa;

    /**
     * @param array $array
     * @return Translations
     */
    public static function fromArray(array $array): Translations
    {
        return new self(
            $array['de'] ?? '',
            $array['es'] ?? '',
            $array['fr'] ?? '',
            $array['ja'] ?? '',
            $array['it'] ?? '',
            $array['br'] ?? '',
            $array['pt'] ?? '',
            $array['nl'] ?? '',
            $array['hr'] ?? '',
            $array['fa'] ?? ''
        );
    }

    /**
     * Translation constructor.
     * @param string $de
     * @param string $es
     * @param string $fr
     * @param string $ja
     * @param string $it
     * @param string $br
     * @param string $pt
     * @param string $nl
     * @param string $hr
     * @param string $fa
     */
    public function __construct(
        string $de,
        string $es,
        string $fr,
        string $ja,
        string $it,
        string $br,
        string $pt,
        string $nl,
        string $hr,
        string $fa
    ) {
        $this->de = $de;
        $this->es = $es;
        $this->fr = $fr;
        $this->ja = $ja;
        $this->it = $it;
        $this->br = $br;
        $this->pt = $pt;
        $this->nl = $nl;
        $this->hr = $hr;
        $this->fa = $fa;
    }

    /**
     * @return string
     */
    public function getDe(): string
    {
        return $this->de;
    }

    /**
     * @return string
     */
    public function getEs(): string
    {
        return $this->es;
    }

    /**
     * @return string
     */
    public function getFr(): string
    {
        return $this->fr;
    }

    /**
     * @return string
     */
    public function getJa(): string
    {
        return $this->ja;
    }

    /**
     * @return string
     */
    public function getIt(): string
    {
        return $this->it;
    }

    /**
     * @return string
     */
    public function getBr(): string
    {
        return $this->br;
    }

    /**
     * @return string
     */
    public function getPt(): string
    {
        return $this->pt;
    }

    /**
     * @return string
     */
    public function getNl(): string
    {
        return $this->nl;
    }

    /**
     * @return string
     */
    public function getHr(): string
    {
        return $this->hr;
    }

    /**
     * @return string
     */
    public function getFa(): string
    {
        return $this->fa;
    }
}