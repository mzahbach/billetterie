<?php

namespace App\Repository;

use App\Entity\Ext;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Ext|null find($id, $lockMode = null, $lockVersion = null)
 * @method Ext|null findOneBy(array $criteria, array $orderBy = null)
 * @method Ext[]    findAll()
 * @method Ext[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ExtRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Ext::class);
    }

    // /**
    //  * @return Ext[] Returns an array of Ext objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('e.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Ext
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
