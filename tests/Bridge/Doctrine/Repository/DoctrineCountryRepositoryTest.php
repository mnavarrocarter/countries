<?php

namespace MNC\Countries\Tests\Bridge\Doctrine\Repository;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Tools\Setup;
use MNC\Countries\Bridge\Doctrine\Repository\DoctrineCountryRepository;
use MNC\Countries\Country\Country;
use PHPUnit\Framework\TestCase;

class DoctrineCountryRepositoryTest extends TestCase
{
    /** @var EntityManagerInterface */
    private static $manager;

    /**
     * @return EntityManagerInterface
     */
    private function getManager(): EntityManagerInterface
    {
        return static::$manager;
    }

    /**
     * @return DoctrineCountryRepository
     */
    private function getRepository(): DoctrineCountryRepository
    {
        return $this->getManager()->getRepository(Country::class);
    }

    /**
     * @throws \Doctrine\ORM\ORMException
     */
    public static function setUpBeforeClass()
    {
        $isDevMode = true;
        $config = Setup::createXMLMetadataConfiguration([__DIR__.'/../../../../src/Bridge/Doctrine/Mappings'], $isDevMode, null);

        $conn = array(
            'driver' => 'pdo_sqlite',
            'path' => __DIR__.'/../../../../db.sqlite',
        );

        static::$manager = EntityManager::create($conn, $config);
    }

    public function testByRegionalBloc()
    {
        $collection = $this->getRepository()->byRegionalBloc('NAFTA');

        $this->assertCount(3, $collection);
    }

    public function testByListOfCodes()
    {
        $collection = $this->getRepository()->byListOfCodes(['US', 'CL']);

        $this->assertCount(2, $collection);
    }

    public function testByName()
    {
        $collection = $this->getRepository()->byName('Burma');

        $this->assertCount(1, $collection);
        $this->assertEquals('Myanmar', $collection[0]->getName());
    }

    public function testByCallingCode()
    {
        $collection = $this->getRepository()->byCallingCode('56');

        $this->assertCount(1, $collection);
        $this->assertEquals('Chile', $collection[0]->getName());
    }

    public function testAll()
    {
        $collection = $this->getRepository()->all();
        $this->assertCount(250, $collection);
    }

    public function testByLanguageCode()
    {
        $collection = $this->getRepository()->byLanguageCode('es');
        $this->assertCount(24, $collection);
    }

    public function testByCurrencyCode()
    {
        $collection = $this->getRepository()->byCurrencyCode('CLP');

        $this->assertCount(1, $collection);
    }

    public function testByRegion()
    {
        $collection = $this->getRepository()->byRegion('South America');

        $this->assertCount(15, $collection);
    }

    public function testByCapitalCity()
    {
        $collection = $this->getRepository()->byCapitalCity('Santiago');

        $this->assertCount(1, $collection);
        $this->assertEquals('Chile', $collection[0]->getName());
    }

    public function testByCode()
    {
        $country = $this->getRepository()->byCode('CL');
        $this->assertEquals('Chile', $country->getName());
    }

    public function testByFullName()
    {
        $collection = $this->getRepository()->byFullName('Chile');
        $this->assertCount(1, $collection);
        $this->assertEquals('Chile', $collection[0]->getName());
    }
}
