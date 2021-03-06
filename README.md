MNC Country Info
================

A PHP library for working with Country information as objects, consumed from
[https://restcountries.eu/](https://restcountries.eu/).

## Installation

Install is done via composer:

    composer require mnavarrocarter/countries

## Usage

### The Country Fetcher


### The CountryRepositoryInterface

### The CountryCollection object

## Doctrine Integration

This library contains a doctrine repository implementing the CountryRepository and
doctrine mappings for the different objects that compose the Country aggregate root.

## Symfony Bundle Config

This library is also bridged to be used a Symfony Bundle. You can customize almost every
aspect of the workings of the library, like defining the default Repository to use,
and configuring other options like caching.

```yaml
mnc_countries:
    repository:
        # Alias to the interface
        default: mnc_countries.in_memory_repository
        # If true, the default one will be DoctrineCountryRepository
        use_doctrine: true
    fetcher:
        # Alias to the interface
        default: mnc_countries.object_fetcher
        # If true, the default one will be CacheCountryFectherDecorator
        use_cache_decorator: true
        # Cache service id. Redis is pretty efficient.
        cache: Psr\SimpleCache\CacheInterface
```