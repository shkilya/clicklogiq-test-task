<?php

namespace App\Repository;

use App\Entity\HazardousAsteroids;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method HazardousAsteroids|null find($id, $lockMode = null, $lockVersion = null)
 * @method HazardousAsteroids|null findOneBy(array $criteria, array $orderBy = null)
 * @method HazardousAsteroids[]    findAll()
 * @method HazardousAsteroids[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class HazardousAsteroidsRepository extends ServiceEntityRepository
{
    private const DEFAULT_LIMIT = 20;


    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, HazardousAsteroids::class);
    }

    // /**
    //  * @return HazardousAsteroids[] Returns an array of HazardousAsteroids objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('h')
            ->andWhere('h.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('h.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?HazardousAsteroids
    {
        return $this->createQueryBuilder('h')
            ->andWhere('h.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */


    /**
     * @param int|null $offset
     * @param int|null $maxResults
     * @return HazardousAsteroids[]|null
     */
    public function getAll(int $offset = null, int $maxResults = null)
    {
        $queryBuilder = $this->createQueryBuilder('h')
            ->getQuery();

        if (!is_null($offset)) {
            $queryBuilder->setFirstResult($offset);
        }

        if (!is_null($maxResults)) {
            $queryBuilder->setMaxResults($maxResults);
        }

        return $queryBuilder->getResult();
    }


    /**
     * @param bool $hazardous
     * @return HazardousAsteroids|null
     */
    public function getFasterAsteroid(bool $hazardous = false)
    {
        $queryBuilder = $this->createQueryBuilder('h');
        $queryBuilder->select('h');
        $queryBuilder
            ->where('h.isPotentiallyHazardousAsteroid = :isPotentiallyHazardousAsteroid')
            ->setParameter('isPotentiallyHazardousAsteroid', $hazardous);
        $queryBuilder->orderBy('h.kilometersPerHour','DESC');
        $queryBuilder->setMaxResults(1);

        return $queryBuilder->getQuery()->getResult();
    }



    /**
     * select YEAR(date), MONTH(date) ,count(*) as  count_record from hazardous_asteroids
    group by YEAR(date), MONTH(date)  order by count_record desc

     *
     * @param bool $hazardous
     * @return HazardousAsteroids|null
     */
    public function getBestMonth(bool $hazardous = false)
    {
        $queryBuilder = $this->createQueryBuilder('h');
        $queryBuilder->select(' MONTH(h.date),count(h.date) as  count_record');
        $queryBuilder
            ->where('h.isPotentiallyHazardousAsteroid = :isPotentiallyHazardousAsteroid')
            ->setParameter('isPotentiallyHazardousAsteroid', $hazardous);
//        $queryBuilder->orderBy('count_record','DESC');
        $queryBuilder->groupBy(' MONTH(h.date) ');

        $queryBuilder->setMaxResults(1);

        return $queryBuilder->getQuery()->getResult();
    }

}
