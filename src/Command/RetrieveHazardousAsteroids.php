<?php
declare(strict_types=1);

namespace App\Command;

use App\Entity\HazardousAsteroids;
use App\Repository\HazardousAsteroidsRepository;
use App\Utils\Managers\HazardousAsteroidsApiManager;
use Doctrine\DBAL\Exception\UniqueConstraintViolationException;
use Doctrine\ORM\EntityManagerInterface;
use Psr\Log\LoggerInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Class RetrieveHazardousAsteroids
 * @package App\Command
 */
class RetrieveHazardousAsteroids extends Command
{
    private const PARAM_DAYS         = 'days'
    ;
    private const DEFAULT_PARAM_DAYS = 3;

    /**
     * @var HazardousAsteroidsApiManager
     */
    private $hazardousAsteroidsManager;

    /**
     * @var EntityManagerInterface
     */
    private $entityManager;
    /**
     * @var LoggerInterface
     */
    private $logger;
    /**
     * @var HazardousAsteroidsRepository
     */
    private $hazardousAsteroidsRepository;


    public function __construct(
        HazardousAsteroidsApiManager $hazardousAsteroidsManager,
        EntityManagerInterface $entityManager,
        HazardousAsteroidsRepository $hazardousAsteroidsRepository,
        LoggerInterface $logger
    )
    {
        parent::__construct();
        $this->hazardousAsteroidsManager    = $hazardousAsteroidsManager;
        $this->entityManager                = $entityManager;
        $this->logger                       = $logger;
        $this->hazardousAsteroidsRepository = $hazardousAsteroidsRepository;
    }

    protected function configure()
    {
        $this
            ->setName('app:retrieve-hazardous-asteroids')
            ->setDescription('Retrieve hazardous asteroids')
            ->addArgument(
                self::PARAM_DAYS,
                InputArgument::OPTIONAL,
                'days',
                null
            );
    }


    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $days = (int)($input->getArgument(self::PARAM_DAYS)??self::DEFAULT_PARAM_DAYS);


        $hazardousAsteroids = $this->hazardousAsteroidsManager->getAll($days);

        foreach ($hazardousAsteroids as $hazardousAsteroid) {

            //TODO : refactor this - get all  neoReferenceIds from request ,  check database record

            $existingRecord = $this->hazardousAsteroidsRepository
                ->findOneBy(['neoReferenceId' => $hazardousAsteroid->getNeoReferenceId()]);

            if ($existingRecord) {
                continue;
            }

            $hazardousAsteroidEntity = (new HazardousAsteroids)
                ->setDate($hazardousAsteroid->getDate())
                ->setName($hazardousAsteroid->getName())
                ->setNeoReferenceId($hazardousAsteroid->getNeoReferenceId())
                ->setKilometersPerHour($hazardousAsteroid->getKilometersPerHour())
                ->setIsPotentiallyHazardousAsteroid($hazardousAsteroid->isPotentiallyHazardousAsteroid());

            $this->entityManager->persist($hazardousAsteroidEntity);
        }

        $this->entityManager->flush();


        $output->writeln('Hazardous Asteroid has been added');
        return 0;
    }

}