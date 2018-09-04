<?php

namespace MNC\Countries\Tests\DependencyInjection;

use Doctrine\Bundle\DoctrineBundle\DoctrineBundle;
use MNC\Countries\Bridge\Symfony\MNCCountriesBundle;
use MNC\Countries\Fetcher\CacheCountryFetcherDecorator;
use MNC\Countries\Fetcher\CountryFetcher;
use PHPUnit\Framework\TestCase;
use Symfony\Bundle\FrameworkBundle\FrameworkBundle;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\Config\Loader\LoaderInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\DependencyInjection\ServiceLocator;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\HttpKernel\Kernel;

class ServiceWiringTest extends KernelTestCase
{
    public function tearDown()
    {
        $fs = new Filesystem();
        $fs->remove(__DIR__ . '/cache');
        $fs->remove(__DIR__ . '/logs');
    }

    protected static function getKernelClass(): string
    {
        return TestKernel::class;
    }

    public function testContainerBoots(): void
    {
        static::bootKernel();
        $this->assertInstanceOf(ContainerInterface::class, static::$container);
    }

    public function testDefaultServices()
    {
        static::bootKernel();
        $testContainer = self::$container;

        $fetcher = $testContainer->get(CountryFetcher::class);

        $this->assertInstanceOf(CacheCountryFetcherDecorator::class, $fetcher);
    }
}

class TestKernel extends Kernel
{
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
            $containerBuilder->loadFromExtension('mnc_countries');
            $containerBuilder->loadFromExtension('doctrine');
        });
    }
}
