<?php

namespace App\Repository;

use App\Entity\Sommet;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Sommet|null find($id, $lockMode = null, $lockVersion = null)
 * @method Sommet|null findOneBy(array $criteria, array $orderBy = null)
 * @method Sommet[]    findAll()
 * @method Sommet[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SommetRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Sommet::class);
    }

    // /**
    //  * @return Sommet[] Returns an array of Sommet objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('s.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Sommet
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
