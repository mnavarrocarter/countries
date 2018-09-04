<?php

namespace MNC\Countries\Bridge\Doctrine\Repository;

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;
use MNC\Countries\Country\Country;
use MNC\Countries\Country\CountryCollection;
use MNC\Countries\Exception\CountryNotFoundException;
use MNC\Countries\Repository\CountryRepository;

/**
 * Class DoctrineCountryRepository
 * @package MNC\Countries\Bridge\Doctrine\Repository
 * @author Matías Navarro Carter <mnavarro@option.cl>
 */
class DoctrineCountryRepository extends ServiceEntityRepository implements CountryRepository
{
    /**
     * DoctrineCountryRepository constructor.
     * @param ManagerRegistry $registry
     */
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Country::class);
    }

    /**
     * @inheritdoc
     */
    public function add(Country $country): void
    {
        $this->getEntityManager()->persist($country);
    }

    /**
     * @inheritdoc
     */
    public function all(): CountryCollection
    {
        return new CountryCollection($this->findAll());
    }

    public function byName(string $name): CountryCollection
    {
        $qb = $this->createQueryBuilder('c');
        $qb
            ->where($qb->expr()->orX(
                $qb->expr()->like('c.name', ':name'),
                $qb->expr()->like('c.nativeName', ':name'),
                $qb->expr()->like('c.altSpellings', ':name')
            ))
            ->setParameter('name', '%'.$name.'%')
        ;
        return new CountryCollection($qb->getQuery()->getResult());
    }

    /**
     * @inheritdoc
     */
    public function byFullName(string $fullName): CountryCollection
    {
        $qb = $this->createQueryBuilder('c');
        $qb
            ->where($qb->expr()->orX(
                $qb->expr()->eq('c.name', ':fullName'),
                $qb->expr()->eq('c.nativeName', ':fullName'),
                $qb->expr()->eq('c.altSpellings', ':fullName')
            ))
            ->setParameter('fullName', $fullName)
        ;
        return new CountryCollection($qb->getQuery()->getResult());
    }

    /**
     * @param string $isoCode
     * @return Country
     */
    public function byCode(string $isoCode): Country
    {
        $country = $this->find($isoCode);
        if ($country instanceof Country) {
            return $country;
        }
        throw CountryNotFoundException::countryCode($isoCode);
    }

    /**
     * @inheritdoc
     */
    public function byListOfCodes(array $isoCodes): CountryCollection
    {
        $qb = $this->createQueryBuilder('c');
        $qb
            ->where(
                $qb->expr()->orX(
                    $qb->expr()->in('c.alpha2Code', ':codes'),
                    $qb->expr()->in('c.alpha3Code', ':codes')
                )
            )
            ->setParameter('codes', $isoCodes)
        ;

        return new CountryCollection($qb->getQuery()->getResult());
    }

    /**
     * @inheritdoc
     */
    public function byCurrencyCode(string $currencyCode): CountryCollection
    {
        $qb = $this->createQueryBuilder('c');
        $qb
            ->innerJoin('c.currencies', 'cu')
            ->where($qb->expr()->eq('cu.code', ':code'))
            ->setParameter('code', $currencyCode)
        ;

        return new CountryCollection($qb->getQuery()->getResult());
    }

    /**
     * @inheritdoc
     */
    public function byLanguageCode(string $languageCode): CountryCollection
    {
        $qb = $this->createQueryBuilder('c');
        $qb
            ->innerJoin('c.languages', 'l')
            ->where(
                $qb->expr()->orX(
                    $qb->expr()->eq('l.iso639_1', ':languageCode'),
                    $qb->expr()->eq('l.iso639_2', ':languageCode')

                )
            )
            ->setParameter('languageCode', $languageCode)
        ;

        return new CountryCollection($qb->getQuery()->getResult());
    }

    /**
     * @inheritdoc
     */
    public function byCapitalCity(string $capitalCity): CountryCollection
    {
        $qb = $this->createQueryBuilder('c');
        $qb
            ->where($qb->expr()->like('c.capital', ':capital'))
            ->setParameter('capital', '%'.$capitalCity.'%')
        ;

        return new CountryCollection($qb->getQuery()->getResult());
    }

    /**
     * @inheritdoc
     */
    public function byCallingCode(string $callingCode): CountryCollection
    {
        $qb = $this->createQueryBuilder('c');
        $qb
            ->where($qb->expr()->like('c.callingCodes', ':callingCode'))
            ->setParameter('callingCode', '%'.$callingCode.'%')
        ;
        // Fix for Doctrine not able to query json.
        return (new CountryCollection($qb->getQuery()->getResult()))->byCallingCode($callingCode);
    }

    /**
     * @inheritdoc
     */
    public function byRegion(string $region): CountryCollection
    {
        $qb = $this->createQueryBuilder('c');
        $qb
            ->where($qb->expr()->orX(
                $qb->expr()->eq('c.region', ':region'),
                $qb->expr()->eq('c.subregion', ':region')
            ))
            ->setParameter('region', $region)
        ;
        return new CountryCollection($qb->getQuery()->getResult());
    }

    /**
     * @inheritdoc
     */
    public function byRegionalBloc(string $regionalBloc): CountryCollection
    {
        $qb = $this->createQueryBuilder('c');
        $qb
            ->innerJoin('c.regionalBlocs', 'rb')
            ->where('rb.acronym = :bloc')
            ->setParameter('bloc', $regionalBloc)
        ;

        return new CountryCollection($qb->getQuery()->getResult());
    }
}