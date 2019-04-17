<?php

namespace App\Repository;

use App\Entity\Contenucommande;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Contenucommande|null find($id, $lockMode = null, $lockVersion = null)
 * @method Contenucommande|null findOneBy(array $criteria, array $orderBy = null)
 * @method Contenucommande[]    findAll()
 * @method Contenucommande[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ContenucommandeRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Contenucommande::class);
    }

    // /**
    //  * @return Contenucommande[] Returns an array of Contenucommande objects
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
    public function findOneBySomeField($value): ?Contenucommande
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
