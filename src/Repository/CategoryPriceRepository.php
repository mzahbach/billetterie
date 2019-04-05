<?php

namespace App\Repository;

use App\Entity\CategoryPrice;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;
use App\Entity\Evenement;

/**
 * @method CategoryPrice|null find($id, $lockMode = null, $lockVersion = null)
 * @method CategoryPrice|null findOneBy(array $criteria, array $orderBy = null)
 * @method CategoryPrice[]    findAll()
 * @method CategoryPrice[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CategoryPriceRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, CategoryPrice::class);
    }

    /**
     * Undocumented function
     *
     * @param Evenement $event
     * @return CategoryPrice[] Returns an array of CategoryPrice objects
     */
    public function findbyEvent(Evenement $event)
    {
        $id_event=$event->getId();
        return $this->createQueryBuilder('c')
            ->andWhere('c.event = :val')
            ->setParameter('val', $id_event)
            ->orderBy('c.id', 'ASC')
            ->getQuery()
            ->getResult()
        ;


    }

    // /**
    //  * @return CategoryPrice[] Returns an array of CategoryPrice objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('c.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?CategoryPrice
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
