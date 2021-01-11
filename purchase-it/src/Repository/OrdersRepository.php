<?php

namespace App\Repository;

use App\Entity\Orders;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Orders|null find($id, $lockMode = null, $lockVersion = null)
 * @method Orders|null findOneBy(array $criteria, array $orderBy = null)
 * @method Orders[]    findAll()
 * @method Orders[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class OrdersRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Orders::class);
    }

    /**
     * @return Orders[] Returns an array of Orders objects
     */
    public function findOrdersByFilters($customerId, $fromDate, $toDate)
    {
        return $this->createQueryBuilder('o')
            ->andWhere('o.processedAt >= :fromDate')
            ->andWhere('o.processedAt <= :toDate')
            ->andWhere('o.realCustomerId = :customerId')
            ->setParameter('customerId', $customerId)
            ->setParameter('fromDate', $fromDate)
            ->setParameter('toDate', $toDate)
            ->getQuery()
            ->getResult()
        ;
    }

    /**
     * @return Orders[] Returns an array of Orders objects
     */
    public function findProcessedOrdersByDate($customerId, $toDate)
    {
        return $this->createQueryBuilder('o')
            ->andWhere('o.processedAt <= :toDate')
            ->andWhere('o.realCustomerId = :customerId')
            ->setParameter('customerId', $customerId)
            ->setParameter('toDate', $toDate)
            ->getQuery()
            ->getResult()
        ;
    }
    
    /*
    public function findOneBySomeField($value): ?Orders
    {
        return $this->createQueryBuilder('o')
            ->andWhere('o.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
