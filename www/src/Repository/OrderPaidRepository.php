<?php

namespace App\Repository;

use App\Entity\OrderPaid;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method OrderPaid|null find($id, $lockMode = null, $lockVersion = null)
 * @method OrderPaid|null findOneBy(array $criteria, array $orderBy = null)
 * @method OrderPaid[]    findAll()
 * @method OrderPaid[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class OrderPaidRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, OrderPaid::class);
    }

    // /**
    //  * @return OrderPaid[] Returns an array of OrderPaid objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('o')
            ->andWhere('o.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('o.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?OrderPaid
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
