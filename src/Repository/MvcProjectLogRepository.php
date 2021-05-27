<?php

namespace App\Repository;

use App\Entity\MvcProjectLog;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @codeCoverageIgnore
 * @method MvcProjectLog|null find($id, $lockMode = null, $lockVersion = null)
 * @method MvcProjectLog|null findOneBy(array $criteria, array $orderBy = null)
 * @method MvcProjectLog[]    findAll()
 * @method MvcProjectLog[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MvcProjectLogRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, MvcProjectLog::class);
    }

    // /**
    //  * @return MvcProjectLog[] Returns an array of MvcProjectLog objects
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
    public function findOneBySomeField($value): ?MvcProjectLog
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
