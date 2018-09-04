<?php

namespace MNC\Countries\Bridge\Symfony\DependencyInjection\Compiler;

use Doctrine\Common\Persistence\ManagerRegistry;
use Doctrine\ORM\EntityManagerInterface;
use MNC\Countries\Bridge\Doctrine\Repository\DoctrineCountryRepository;
use MNC\Countries\Repository\CountryRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Definition;
use Symfony\Component\DependencyInjection\Reference;

/**
 * Class DoctrineCompilerPass
 * @package MNC\Countries\Bridge\Symfony\DependencyInjection\Compiler
 * @author Matías Navarro Carter <mnavarro@option.cl>
 */
class DoctrineCompilerPass implements CompilerPassInterface
{
    public function process(ContainerBuilder $container)
    {
        if ($container->has(ManagerRegistry::class)) {

            $definition = new Definition(DoctrineCountryRepository::class, [
                new Reference(ManagerRegistry::class)
            ]);
            $container->setDefinition('mnc_countries.orm_country_repository', $definition);

            $container->setAlias(CountryRepository::class, new Reference('mnc_countries.orm_country_repository'));
        }
    }
}