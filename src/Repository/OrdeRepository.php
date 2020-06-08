<?php

namespace App\Repository;

use App\Entity\Orde;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Orde|null find($id, $lockMode = null, $lockVersion = null)
 * @method Orde|null findOneBy(array $criteria, array $orderBy = null)
 * @method Orde[]    findAll()
 * @method Orde[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class OrdeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Orde::class);
    }

    // /**
    //  * @return Orde[] Returns an array of Orde objects
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
    public function findOneBySomeField($value): ?Orde
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
