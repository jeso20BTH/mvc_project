<?php

namespace App\Repository;

use App\Entity\MvcProjectTurnLog;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method MvcProjectTurnLog|null find($id, $lockMode = null, $lockVersion = null)
 * @method MvcProjectTurnLog|null findOneBy(array $criteria, array $orderBy = null)
 * @method MvcProjectTurnLog[]    findAll()
 * @method MvcProjectTurnLog[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MvcProjectTurnLogRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, MvcProjectTurnLog::class);
    }

    // /**
    //  * @return MvcProjectTurnLog[] Returns an array of MvcProjectTurnLog objects
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
    public function findOneBySomeField($value): ?MvcProjectTurnLog
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
