<?php

namespace MNC\Countries\Bridge\Symfony\DependencyInjection;

use MNC\Countries\Fetcher\CacheCountryFetcherDecorator;
use MNC\Countries\Fetcher\CountryFetcher;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Definition;
use Symfony\Component\DependencyInjection\Extension\Extension;
use Symfony\Component\DependencyInjection\Loader;
use Symfony\Component\DependencyInjection\Reference;

/**
 * Class MNCCountriesExtension
 * @package MNC\Countries\DependencyInjection
 * @author Matías Navarro Carter mnavarrocarter@gmail.com
 */
class MNCCountriesExtension extends Extension
{
    /**
     * This is the alias name of your bundle.
     * Is the key to use in your yaml configuration.
     * @return string
     */
    public function getAlias(): string
    {
        return 'mnc_countries';
    }

    /** @inheritdoc */
    public function load(array $configs, ContainerBuilder $container)
    {
        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $configs);

        $loader = new Loader\XmlFileLoader($container, new FileLocator(__DIR__ . '/../Resources/config'));
        $loader->load('services.xml');

        $container->setAlias(CountryFetcher::class, $config['fetcher']['default']);

        if ($config['fetcher']['use_cache_decorator'] === true) {
            $definition = new Definition(CacheCountryFetcherDecorator::class, [
                new Reference($config['fetcher']['default']),
                new Reference($config['fetcher']['cache'])
            ]);

            $container->setDefinition('mnc_countries.cacheable_fetcher', $definition);
            $container->setAlias(CountryFetcher::class, 'mnc_countries.cacheable_fetcher');
        }
    }
}