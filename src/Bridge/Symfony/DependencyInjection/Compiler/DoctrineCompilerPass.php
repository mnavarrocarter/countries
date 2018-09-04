<?php

namespace MNC\Countries\Bridge\Symfony\DependencyInjection\Compiler;

use Doctrine\Bundle\DoctrineBundle\Command\Proxy\ImportDoctrineCommand;
use Doctrine\Common\Persistence\ManagerRegistry;
use Doctrine\ORM\EntityManagerInterface;
use MNC\Countries\Bridge\Doctrine\Repository\DoctrineCountryRepository;
use MNC\Countries\Bridge\Symfony\Command\ImportDoctrineCountriesCommand;
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
            // Repository
            $definition = new Definition(DoctrineCountryRepository::class, [
                new Reference(ManagerRegistry::class)
            ]);
            $container->setDefinition('mnc_countries.orm_country_repository', $definition);
            $container->setAlias(CountryRepository::class,'mnc_countries.orm_country_repository');

            // Command
            $command = new Definition(ImportDoctrineCountriesCommand::class, [new Reference(ManagerRegistry::class)]);
            $command->addTag('console.command');
            $container->setDefinition('mnc_countries.doctrine_import_command', $definition);
        }
    }
}