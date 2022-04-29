<?php

namespace App\Repository;

use App\Entity\RechercheExercice;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method RechercheExercice|null find($id, $lockMode = null, $lockVersion = null)
 * @method RechercheExercice|null findOneBy(array $criteria, array $orderBy = null)
 * @method RechercheExercice[]    findAll()
 * @method RechercheExercice[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RechercheExerciceRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, RechercheExercice::class);
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function add(RechercheExercice $entity, bool $flush = true): void
    {
        $this->_em->persist($entity);
        if ($flush) {
            $this->_em->flush();
        }
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function remove(RechercheExercice $entity, bool $flush = true): void
    {
        $this->_em->remove($entity);
        if ($flush) {
            $this->_em->flush();
        }
    }

    // /**
    //  * @return RechercheExercice[] Returns an array of RechercheExercice objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('r.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?RechercheExercice
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
