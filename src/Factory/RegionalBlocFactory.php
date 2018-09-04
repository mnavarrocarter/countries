<?php

namespace MNC\Countries\Factory;

use MNC\Countries\Country\RegionalBloc;

/**
 * Class RegionalBlocFactory
 * @package MNC\Countries\Factory
 * @author Matías Navarro Carter <mnavarro@option.cl>
 */
class RegionalBlocFactory
{
    /**
     * @param array $collection
     * @return array|RegionalBloc[]
     */
    public static function createFromCollection(array $collection): array
    {
        $blocs = [];
        foreach ($collection as $entry) {
            $blocs[] = self::createFromEntry($entry);
        }
        return $blocs;
    }

    /**
     * @param array $entry
     * @return RegionalBloc
     */
    public static function createFromEntry(array $entry): RegionalBloc
    {
        return new RegionalBloc(
            $entry['acronym'],
            $entry['name'],
            $entry['otherAcronyms'],
            $entry['otherNames']
        );
    }
}