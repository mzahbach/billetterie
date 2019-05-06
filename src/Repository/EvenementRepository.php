<?php

namespace App\Repository;

use App\Entity\Evenement;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;
use App\Entity\PropertySearch;
use App\Entity\Category;
use Symfony\Component\Validator\Constraints\DateTime;

/**
 * @method Evenement|null find($id, $lockMode = null, $lockVersion = null)
 * @method Evenement|null findOneBy(array $criteria, array $orderBy = null)
 * @method Evenement[]    findAll()
 * @method Evenement[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class EvenementRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Evenement::class);
    }
    

    /**
     * @return Evenement[] 
     */
    public function OrderByDate()
    {
        return $this->createQueryBuilder('e')
            ->orderBy('e.debutAt','DESC')
            ->getQuery()
            ->getResult()
            ;
    }

    

    /**
     * @return Evenement[] 
     */
    public function findByCategiryDAt(Category $cat )
    {
        dump($cat);
        return $this->createQueryBuilder('e')
            ->where('e.category = :val')
            ->setParameter('val', $cat->getId())
            ->orderBy('e.debutAt','DESC')
            ->getQuery()
            ->getResult()
            ;
    }
    /**
     * @return Evenement[] 
     */
    public function findBytitre(string $search)
    {
        return $this->createQueryBuilder('e')
            ->where('e.titre LIKE :val OR e.debutAt LIKE :val OR e.finAt LIKE :val OR e.prix LIKE :val ')
            ->setParameter('val', '%'.$search.'%')
            ->orderBy('e.debutAt','DESC')
            ->getQuery()
            ->getResult()
            ;
    }

    /**
     * @return Evenement[] 
     */
    public function findDate(PropertySearch $search)
    {
        return $this->createQueryBuilder('e')
            ->where('e.titre LIKE :val OR e.debutAt LIKE :val OR e.finAt LIKE :val OR e.prix LIKE :val ')
            ->setParameter('val', '%'.$search->getTitreSearch().'%')
            ->orderBy('e.debutAt','DESC')
            ->getQuery()
            ->getResult()
            ;
    }


    // /**
    //  * @return Evenement[] Returns an array of Evenement objects
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
    public function findOneBySomeField($value): ?Evenement
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
