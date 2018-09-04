<?php

namespace MNC\Countries\Bridge\Symfony\Command;

use Doctrine\ORM\EntityManagerInterface;
use MNC\Countries\Bridge\Doctrine\Importer\DoctrineCountryImporter;
use MNC\Countries\Country\Country;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

/**
 * Class ImportDoctrineCountries
 * @package MNC\Countries\Bridge\Symfony\Command
 * @author Matías Navarro Carter <mnavarro@option.cl>
 */
class ImportDoctrineCountriesCommand extends Command
{
    public static $defaultName = 'countries:doctrine:import';

    /**
     * @var EntityManagerInterface
     */
    private $entityManager;

    /**
     * ImportDoctrineCountriesCommand constructor.
     * @param EntityManagerInterface $entityManager
     */
    public function __construct(EntityManagerInterface $entityManager = null)
    {
        parent::__construct(static::$defaultName);
        $this->entityManager = $entityManager;
    }

    public function configure(): void
    {
        $this->setName(static::$defaultName)
            ->setDescription('Imports Countries entities to your database using the Entity Manager')
        ;
    }

    /**
     * @param InputInterface  $input
     * @param OutputInterface $output
     * @return int|null|void
     */
    public function execute(InputInterface $input, OutputInterface $output)
    {
        $io = new SymfonyStyle($input, $output);

        // To use in doctrine and symfony
        if ($this->entityManager === null) {
            $this->entityManager = $this->getHelper('em')->getEntityManager();
        }

        $importer = new DoctrineCountryImporter($this->entityManager);

        $number = $importer->import(function (Country $country, $number) use ($io) {
            $io->write(sprintf('%s. %s has been imported...', $number, $country->getName()));
            $io->newLine();
        });

        $io->success(sprintf('%s countries have been imported...', $number));
    }
}