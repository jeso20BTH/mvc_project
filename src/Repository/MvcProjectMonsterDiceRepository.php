<?php

namespace App\Repository;

use App\Entity\MvcProjectMonsterDice;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @codeCoverageIgnore
 * @method MvcProjectMonsterDice|null find($id, $lockMode = null, $lockVersion = null)
 * @method MvcProjectMonsterDice|null findOneBy(array $criteria, array $orderBy = null)
 * @method MvcProjectMonsterDice[]    findAll()
 * @method MvcProjectMonsterDice[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MvcProjectMonsterDiceRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, MvcProjectMonsterDice::class);
    }

    // /**
    //  * @return MvcProjectMonsterDice[] Returns an array of MvcProjectMonsterDice objects
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
    public function findOneBySomeField($value): ?MvcProjectMonsterDice
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
