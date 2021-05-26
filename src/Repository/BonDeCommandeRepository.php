<?php

namespace App\Repository;

use App\Entity\BonDeCommande;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method BonDeCommande|null find($id, $lockMode = null, $lockVersion = null)
 * @method BonDeCommande|null findOneBy(array $criteria, array $orderBy = null)
 * @method BonDeCommande[]    findAll()
 * @method BonDeCommande[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BonDeCommandeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, BonDeCommande::class);
    }

    // /**
    //  * @return BonDeCommande[] Returns an array of BonDeCommande objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('b')
            ->andWhere('b.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('b.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?BonDeCommande
    {
        return $this->createQueryBuilder('b')
            ->andWhere('b.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
