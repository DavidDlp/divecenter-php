<?php

namespace App\Repository;

use App\Entity\Inmersiones;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Inmersiones|null find($id, $lockMode = null, $lockVersion = null)
 * @method Inmersiones|null findOneBy(array $criteria, array $orderBy = null)
 * @method Inmersiones[]    findAll()
 * @method Inmersiones[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class InmersionesRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Inmersiones::class);
    }

    // /**
    //  * @return Inmersiones[] Returns an array of Inmersiones objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('i')
            ->andWhere('i.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('i.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Inmersiones
    {
        return $this->createQueryBuilder('i')
            ->andWhere('i.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
