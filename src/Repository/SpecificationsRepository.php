<?php

namespace App\Repository;

use App\Entity\Specifications;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Specifications|null find($id, $lockMode = null, $lockVersion = null)
 * @method Specifications|null findOneBy(array $criteria, array $orderBy = null)
 * @method Specifications[]    findAll()
 * @method Specifications[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SpecificationsRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Specifications::class);
    }

//    /**
//     * @return Specifications[] Returns an array of Specifications objects
//     */
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
    public function findOneBySomeField($value): ?Specifications
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
