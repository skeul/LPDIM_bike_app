<?php

namespace App\Repository;

use App\Entity\Sortie;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Sortie|null find($id, $lockMode = null, $lockVersion = null)
 * @method Sortie|null findOneBy(array $criteria, array $orderBy = null)
 * @method Sortie[]    findAll()
 * @method Sortie[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SortieRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Sortie::class);
    }

     /**
      * @return Sortie[] Returns an array of Sortie objects
      */

    public function findTopParcours($user)
    {
        return $this->createQueryBuilder('s')->select('p.name','COUNT(p.id) AS nbfois')
            ->setParameter('user', $user)
            ->innerJoin('s.users', 'u', 'WITH', 'u.id = :user')
            ->innerJoin('s.parcours', 'p', 'WITH', 'p.id = s.parcours')
            ->groupBy('p.id')
            ->orderBy('nbfois', 'DESC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult();

    }


    public function findLastSorties($user)
    {
        return $this->createQueryBuilder('s')->select('s.nom','s.date_sortie')
            //->andWhere('s.status = 1')
            ->setParameter('user', $user)
            ->innerJoin('s.users', 'u', 'WITH', 'u.id = :user')
            ->orderBy('s.date_sortie', 'DESC')
            ->setMaxResults(4)
            ->getQuery()
            ->getResult();

    }


    public function getTotalDistanceByUser($user)
    {
        return $this->createQueryBuilder('s')
            ->select('sum(p.distance)')
            ->leftJoin('s.users', 'u', 'WITH', 'u.id = :user')
            ->setParameter('user', $user)
            ->andWhere('u.id IS NOT NULL')
            ->andWhere('s.status = 2')
            ->leftJoin('s.parcours', 'p', 'WITH', 'p.id = s.parcours')
            ->groupBy('u.id')
            ->getQuery()
            ->getResult();
    }

    /*
    public function findOneBySomeField($value): ?Sortie
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