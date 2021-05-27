<?php

namespace App\Repository;

use App\Entity\MvcProjectHighscore;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @codeCoverageIgnore
 * @method MvcProjectHighscore|null find($id, $lockMode = null, $lockVersion = null)
 * @method MvcProjectHighscore|null findOneBy(array $criteria, array $orderBy = null)
 * @method MvcProjectHighscore[]    findAll()
 * @method MvcProjectHighscore[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MvcProjectHighscoreRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, MvcProjectHighscore::class);
    }

    // /**
    //  * @return MvcProjectHighscore[] Returns an array of MvcProjectHighscore objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('m.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?MvcProjectHighscore
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
