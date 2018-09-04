<?php

namespace MNC\Countries\Factory;

use MNC\Countries\Country\Language;

/**
 * Class LanguageFactory
 * @package MNC\Countries\Factory
 * @author Matías Navarro Carter <mnavarro@option.cl>
 */
class LanguageFactory
{
    /**
     * @param array $collection
     * @return array|Language[]
     */
    public static function createFromCollection(array $collection): array
    {
        $languages = [];
        foreach ($collection as $entry) {
            $languages[] = self::createFromEntry($entry);
        }
        return $languages;
    }

    /**
     * @param array $entry
     * @return Language
     */
    public static function createFromEntry(array $entry): Language
    {
        return new Language(
            $entry['iso639_1'] ?? '',
            $entry['iso639_2'],
            $entry['name'] ?? '',
            $entry['nativeName'] ?? ''
        );
    }
}