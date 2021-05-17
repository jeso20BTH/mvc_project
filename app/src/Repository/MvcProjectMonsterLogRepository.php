<?php

namespace App\Repository;

use App\Entity\MvcProjectMonsterLog;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method MvcProjectMonsterLog|null find($id, $lockMode = null, $lockVersion = null)
 * @method MvcProjectMonsterLog|null findOneBy(array $criteria, array $orderBy = null)
 * @method MvcProjectMonsterLog[]    findAll()
 * @method MvcProjectMonsterLog[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MvcProjectMonsterLogRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, MvcProjectMonsterLog::class);
    }

    // /**
    //  * @return MvcProjectMonsterLog[] Returns an array of MvcProjectMonsterLog objects
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
    public function findOneBySomeField($value): ?MvcProjectMonsterLog
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
