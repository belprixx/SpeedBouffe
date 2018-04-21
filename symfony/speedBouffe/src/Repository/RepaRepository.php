<?php

namespace App\Repository;

use App\Entity\Repa;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Repa|null find($id, $lockMode = null, $lockVersion = null)
 * @method Repa|null findOneBy(array $criteria, array $orderBy = null)
 * @method Repa[]    findAll()
 * @method Repa[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RepaRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Repa::class);
    }

//    /**
//     * @return Repa[] Returns an array of Repa objects
//     */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('r.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Repa
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
