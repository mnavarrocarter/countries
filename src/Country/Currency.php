<?php

namespace MNC\Countries\Country;

/**
 * Class Currency
 * @package MNC\Countries\Country
 * @author Matías Navarro Carter <mnavarro@option.cl>
 */
class Currency
{
    /**
     * @var string
     */
    private $code;
    /**
     * @var string
     */
    private $name;
    /**
     * @var string
     */
    private $symbol;

    /**
     * Currency constructor.
     * @param string $code
     * @param string $name
     * @param string $symbol
     */
    public function __construct(string $code, string $name, string $symbol)
    {
        $this->code = $code;
        $this->name = $name;
        $this->symbol = $symbol;
    }

    /**
     * @return string
     */
    public function getCode(): string
    {
        return $this->code;
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
    public function getSymbol(): string
    {
        return $this->symbol;
    }
}