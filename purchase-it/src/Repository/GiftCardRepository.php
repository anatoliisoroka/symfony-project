<?php

namespace App\Repository;

use App\Entity\GiftCard;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method GiftCard|null find($id, $lockMode = null, $lockVersion = null)
 * @method GiftCard|null findOneBy(array $criteria, array $orderBy = null)
 * @method GiftCard[]    findAll()
 * @method GiftCard[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class GiftCardRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, GiftCard::class);
    }

    // /**
    //  * @return GiftCards[] Returns an array of GiftCards objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('g')
            ->andWhere('g.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('g.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?GiftCards
    {
        return $this->createQueryBuilder('g')
            ->andWhere('g.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
