<?php

namespace MNC\Countries\Tests\Repository;

use MNC\Countries\Fetcher\CacheCountryFetcherDecorator;
use MNC\Countries\Fetcher\ObjectCountryFetcher;
use MNC\Countries\Repository\InMemoryCountryRepository;
use PHPUnit\Framework\TestCase;
use Psr\SimpleCache\CacheInterface;

class InMemoryCountryRepositoryTest extends TestCase
{
    /**
     * @var InMemoryCountryRepository
     */
    private static $repository;

    public static function setUpBeforeClass()
    {
        static::$repository = InMemoryCountryRepository::createWithCountries(new CacheCountryFetcherDecorator(
            new ObjectCountryFetcher(),
            new FilesystemTestCache()
        ));
    }

    private function getRepository(): InMemoryCountryRepository
    {
        return static::$repository;
    }

    public function testByLanguageCode()
    {
        $collection = $this->getRepository()->byLanguageCode('es');

        $this->assertCount(24, $collection);
    }

    public function testByFullName()
    {
        $collection = $this->getRepository()->byFullName('Chile');

        $this->assertCount(1, $collection);
    }

    public function testByCurrencyCode()
    {
        $collection = $this->getRepository()->byCurrencyCode('CLP');

        $this->assertCount(1, $collection);
    }

    public function testByRegionalBloc()
    {
        $collection = $this->getRepository()->byRegionalBloc('NAFTA');

        $this->assertCount(3, $collection);
    }

    public function testByListOfCodes()
    {
        $collection = $this->getRepository()->byListOfCodes(['CL', 'US']);
        $this->assertCount(2, $collection);
    }

    public function testByCode()
    {
        $country = $this->getRepository()->byCode('CL');

        $this->assertEquals('Chile', $country->getName());
    }

    public function testByName()
    {
        $collection = $this->getRepository()->byName('Chi');

        $this->assertCount(4, $collection);
    }

    public function testByCallingCode()
    {
        $collection = $this->getRepository()->byCallingCode('56');

        $this->assertCount(1, $collection);
    }

    public function testByCapitalCity()
    {
        $collection = $this->getRepository()->byCapitalCity('Santiago');

        $this->assertCount(1, $collection);
    }

    public function testByRegion()
    {
        $collection = $this->getRepository()->byRegion('South America');

        $this->assertCount(15, $collection);
    }

    public function testAll()
    {
        $collection = $this->getRepository()->all();

        $this->assertCount(250, $collection);
    }
}

class FilesystemTestCache implements CacheInterface
{
    /**
     * @var string
     */
    private $cacheDir;

    public function __construct(string $cacheDir = __DIR__)
    {
        $this->cacheDir = $cacheDir;
    }

    public function get($key, $default = null)
    {
        return unserialize($this->read($key));
    }

    public function set($key, $value, $ttl = null)
    {
        $this->write($key, serialize($value));
    }

    public function delete($key)
    {
        unlink($this->cacheDir.'/'.$key);
    }

    public function clear()
    {
        // TODO: Implement clear() method.
    }

    public function getMultiple($keys, $default = null)
    {
        // TODO: Implement getMultiple() method.
    }

    public function setMultiple($values, $ttl = null)
    {
        // TODO: Implement setMultiple() method.
    }

    public function deleteMultiple($keys)
    {
        foreach ($keys as $key)
        {
            $this->delete($key);
        }
    }

    public function has($key)
    {
        file_exists($this->cacheDir.'/'.$key);
    }

    /**
     * @param string $key
     * @return bool|string
     */
    private function read(string $key)
    {
        return file_get_contents($this->cacheDir.'/'.$key);
    }

    /**
     * @param string $key
     * @param string $data
     */
    private function write(string $key, string $data)
    {
        file_put_contents($this->cacheDir.'/'.$key, $data);
    }
}
