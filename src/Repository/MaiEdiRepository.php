<?php

namespace App\Repository;

use App\Entity\MaiEdi;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method MaiEdi|null find($id, $lockMode = null, $lockVersion = null)
 * @method MaiEdi|null findOneBy(array $criteria, array $orderBy = null)
 * @method MaiEdi[]    findAll()
 * @method MaiEdi[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MaiEdiRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, MaiEdi::class);
    }

    // /**
    //  * @return MaiEdi[] Returns an array of MaiEdi objects
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
    public function findOneBySomeField($value): ?MaiEdi
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
