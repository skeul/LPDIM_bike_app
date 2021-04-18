<?php

namespace App\Repository;

use App\Entity\VTT;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method VTT|null find($id, $lockMode = null, $lockVersion = null)
 * @method VTT|null findOneBy(array $criteria, array $orderBy = null)
 * @method VTT[]    findAll()
 * @method VTT[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class VTTRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, VTT::class);
    }

    // /**
    //  * @return VTT[] Returns an array of VTT objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('v')
            ->andWhere('v.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('v.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?VTT
    {
        return $this->createQueryBuilder('v')
            ->andWhere('v.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
