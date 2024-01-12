<?php

namespace App\Repository;

use App\Entity\AssoAdresseUser;
use App\Entity\User;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<AssoAdresseUser>
 *
 * @method AssoAdresseUser|null find($id, $lockMode = null, $lockVersion = null)
 * @method AssoAdresseUser|null findOneBy(array $criteria, array $orderBy = null)
 * @method AssoAdresseUser[]    findAll()
 * @method AssoAdresseUser[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AssoAdresseUserRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, AssoAdresseUser::class);
    }
//    /**
//     * @return AssoAdresseUser[] Returns an array of AssoAdresseUser objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('a')
//            ->andWhere('a.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('a.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?AssoAdresseUser
//    {
//        return $this->createQueryBuilder('a')
//            ->andWhere('a.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
