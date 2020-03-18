<?php

namespace App\Repository;

use App\Entity\Etude;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;
/**
 * @method Etude|null find($id, $lockMode = null, $lockVersion = null)
 * @method Etude|null findOneBy(array $criteria, array $orderBy = null)
 * @method Etude[]    findAll()
 * @method Etude[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class EtudeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Etude::class);
    }

    public function findLatest(): array
    {
        return $this->createQueryBuilder('e')
        ->setMaxResults(50)
        ->getQuery()
        ->getResult();
    }

    
    /* le nom de la nouvelle fonction findAllVisible  est a rappeler dans le constructeur $etude = $this->repository->findAllVisible
    public function findAllVisible()
    {
        return $this->createQueryBuilder('e')
            ->where('p.sold = false')
            ->getQuery()
            ->getResult();
    }
    */


    // /**
    //  * @return Etude[] Returns an array of Etude objects
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
    public function findOneBySomeField($value): ?Etude
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
