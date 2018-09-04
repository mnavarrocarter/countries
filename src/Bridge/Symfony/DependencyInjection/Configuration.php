<?php

namespace MNC\Countries\Bridge\Symfony\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * This is the class that validates and merges configuration from your app/config files.
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/configuration.html}
 */
class Configuration implements ConfigurationInterface
{
    /**
     * {@inheritdoc}
     */
    public function getConfigTreeBuilder(): TreeBuilder
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('mnc_countries');

        $rootNode
            ->children()
                ->arrayNode('repository')
                    ->addDefaultsIfNotSet()
                    ->children()
                        ->scalarNode('default')
                            ->defaultValue('mnc_countries.in_memory_repository')
                        ->end()
                    ->end()
                ->end()
                ->arrayNode('fetcher')
                    ->addDefaultsIfNotSet()
                    ->children()
                        ->scalarNode('default')
                            ->defaultValue('mnc_countries.object_fetcher')
                        ->end()
                        ->booleanNode('use_cache_decorator')
                            ->defaultTrue()
                        ->end()
                        ->scalarNode('cache')
                            ->defaultValue('Psr\SimpleCache\CacheInterface')
                        ->end()
                    ->end()
                ->end()
            ->end()
        ;

        return $treeBuilder;
    }
}