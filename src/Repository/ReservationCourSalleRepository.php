<?php

namespace App\Repository;

use App\Entity\ReservationCourSalle;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method ReservationCourSalle|null find($id, $lockMode = null, $lockVersion = null)
 * @method ReservationCourSalle|null findOneBy(array $criteria, array $orderBy = null)
 * @method ReservationCourSalle[]    findAll()
 * @method ReservationCourSalle[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ReservationCourSalleRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ReservationCourSalle::class);
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function add(ReservationCourSalle $entity, bool $flush = true): void
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
    public function remove(ReservationCourSalle $entity, bool $flush = true): void
    {
        $this->_em->remove($entity);
        if ($flush) {
            $this->_em->flush();
        }
    }

    // /**
    //  * @return ReservationCourSalle[] Returns an array of ReservationCourSalle objects
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
    public function findOneBySomeField($value): ?ReservationCourSalle
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */

    public function list_Par_Salle($id){
        return $this->createQueryBuilder('r')
            ->where('r.idSalle=:id')
            ->setParameter('id', $id)
            ->getQuery()
            ->getResult();

    }
    public function list_Par_Cour($id){
        return $this->createQueryBuilder('r')
            ->where('r.idCour=:id')
            ->setParameter('id', $id)
            ->getQuery()
            ->getResult();
    }
    public function verifierReservation($idSportif,$idCour){
        return $this->createQueryBuilder('r')
            ->where('r.idCour=:idCour')
            ->andWhere('r.idSportif=:idSportif')
            ->setParameter('idCour', $idCour)
            ->setParameter('idSportif', $idSportif)
            ->getQuery()
            ->getResult();
    }
}
