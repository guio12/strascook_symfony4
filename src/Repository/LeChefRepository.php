<?php

namespace App\Repository;

use App\Entity\LeChef;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method LeChef|null find($id, $lockMode = null, $lockVersion = null)
 * @method LeChef|null findOneBy(array $criteria, array $orderBy = null)
 * @method LeChef[]    findAll()
 * @method LeChef[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class LeChefRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, LeChef::class);
    }

    // /**
    //  * @return LeChef[] Returns an array of LeChef objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('l')
            ->andWhere('l.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('l.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?LeChef
    {
        return $this->createQueryBuilder('l')
            ->andWhere('l.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
