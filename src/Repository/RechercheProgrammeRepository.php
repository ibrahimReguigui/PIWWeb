<?php

namespace App\Repository;

use App\Entity\RechercheProgramme;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<RechecheProgramme>
 *
 * @method RechercheProgramme|null find($id, $lockMode = null, $lockVersion = null)
 * @method RechercheProgramme|null findOneBy(array $criteria, array $orderBy = null)
 * @method RechercheProgramme[]    findAll()
 * @method RechercheProgramme[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RechercheProgrammeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, RechercheProgramme::class);
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function add(RechercheProgramme $entity, bool $flush = true): void
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
    public function remove(RechercheProgramme $entity, bool $flush = true): void
    {
        $this->_em->remove($entity);
        if ($flush) {
            $this->_em->flush();
        }
    }

    // /**
    //  * @return RechecheProgramme[] Returns an array of RechecheProgramme objects
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
    public function findOneBySomeField($value): ?RechecheProgramme
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
