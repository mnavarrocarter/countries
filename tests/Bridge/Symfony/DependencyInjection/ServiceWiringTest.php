<?php

namespace MNC\Countries\Tests\DependencyInjection;

use Doctrine\Bundle\DoctrineBundle\DoctrineBundle;
use MNC\Countries\Bridge\Symfony\MNCCountriesBundle;
use PHPUnit\Framework\TestCase;
use Symfony\Bundle\FrameworkBundle\FrameworkBundle;
use Symfony\Component\Config\Loader\LoaderInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\HttpKernel\Kernel;

class ServiceWiringTest extends TestCase
{
    public function tearDown()
    {
        $fs = new Filesystem();
        $fs->remove(__DIR__ . '/cache');
        $fs->remove(__DIR__ . '/logs');
    }

    public function testContainerBoots(): void
    {
        $container = $this->buildContainer();
        $this->assertInstanceOf(ContainerInterface::class, $container);
    }

    private function buildContainer(array $config = [])
    {
        $kernel = new TestKernel($config);
        $kernel->boot();

        return $kernel->getContainer();
    }
}

class TestKernel extends Kernel
{
    private $config = [];

    public function __construct(array $config = [])
    {
        $this->config = $config;
        parent::__construct('dev', true);
    }

    public function registerBundles()
    {
        return [
            new FrameworkBundle(),
            new DoctrineBundle(),
            new MNCCountriesBundle(),
        ];
    }

    public function registerContainerConfiguration(LoaderInterface $loader)
    {
        $loader->load(function (ContainerBuilder $containerBuilder) {
            $containerBuilder->setParameter('kernel.secret', md5(time()));
            $containerBuilder->loadFromExtension('mnc_countries', $this->config);
            $containerBuilder->loadFromExtension('doctrine');
        });
    }
}
