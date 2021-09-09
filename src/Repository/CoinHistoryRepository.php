<?php

namespace App\Repository;

use App\Entity\CoinHistory;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method CoinHistory|null find($id, $lockMode = null, $lockVersion = null)
 * @method CoinHistory|null findOneBy(array $criteria, array $orderBy = null)
 * @method CoinHistory[]    findAll()
 * @method CoinHistory[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CoinHistoryRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CoinHistory::class);
    }

    // /**
    //  * @return CoinHistory[] Returns an array of CoinHistory objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('c.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?CoinHistory
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
