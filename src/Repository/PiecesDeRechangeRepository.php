<?php

namespace App\Repository;

use App\Entity\PiecesDeRechange;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method PiecesDeRechange|null find($id, $lockMode = null, $lockVersion = null)
 * @method PiecesDeRechange|null findOneBy(array $criteria, array $orderBy = null)
 * @method PiecesDeRechange[]    findAll()
 * @method PiecesDeRechange[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PiecesDeRechangeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, PiecesDeRechange::class);
    }

    // /**
    //  * @return PiecesDeRechange[] Returns an array of PiecesDeRechange objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('p.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?PiecesDeRechange
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
