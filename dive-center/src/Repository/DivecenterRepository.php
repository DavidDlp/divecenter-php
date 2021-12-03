<?php

namespace App\Repository;

use App\Entity\Divecenter;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Divecenter|null find($id, $lockMode = null, $lockVersion = null)
 * @method Divecenter|null findOneBy(array $criteria, array $orderBy = null)
 * @method Divecenter[]    findAll()
 * @method Divecenter[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DivecenterRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Divecenter::class);
    }

    // /**
    //  * @return Divecenter[] Returns an array of Divecenter objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('d.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Divecenter
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
