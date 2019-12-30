<?php

namespace App\Repository;

use App\Entity\SpecialInfo;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method SpecialInfo|null find($id, $lockMode = null, $lockVersion = null)
 * @method SpecialInfo|null findOneBy(array $criteria, array $orderBy = null)
 * @method SpecialInfo[]    findAll()
 * @method SpecialInfo[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SpecialInfoRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, SpecialInfo::class);
    }

    // /**
    //  * @return SpecialInfo[] Returns an array of SpecialInfo objects
    //  */
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
    public function findOneBySomeField($value): ?SpecialInfo
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
