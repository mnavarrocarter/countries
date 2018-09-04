<?php

namespace MNC\Countries\Bridge\Symfony;

use MNC\Countries\Bridge\Symfony\DependencyInjection\Compiler\DoctrineCompilerPass;
use MNC\Countries\Bridge\Symfony\DependencyInjection\MNCCountriesExtension;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Extension\ExtensionInterface;
use Symfony\Component\HttpKernel\Bundle\Bundle;

class MNCCountriesBundle extends Bundle
{
    /**
     * Returns an instance of the container extension.
     * @return ExtensionInterface
     */
    public function getContainerExtension(): ExtensionInterface
    {
        return new MNCCountriesExtension();
    }

    public function build(ContainerBuilder $container)
    {
        $container->addCompilerPass(new DoctrineCompilerPass());
    }
}