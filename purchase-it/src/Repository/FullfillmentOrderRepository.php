<?php

namespace App\Repository;

use App\Entity\FullfillmentOrder;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method FullfillmentOrder|null find($id, $lockMode = null, $lockVersion = null)
 * @method FullfillmentOrder|null findOneBy(array $criteria, array $orderBy = null)
 * @method FullfillmentOrder[]    findAll()
 * @method FullfillmentOrder[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class FullfillmentOrderRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, FullfillmentOrder::class);
    }

    // /**
    //  * @return FullfillmentOrder[] Returns an array of FullfillmentOrder objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('f')
            ->andWhere('f.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('f.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?FullfillmentOrder
    {
        return $this->createQueryBuilder('f')
            ->andWhere('f.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
