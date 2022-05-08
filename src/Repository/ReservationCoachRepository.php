<?php

namespace App\Repository;

use App\Entity\ReservationCoach;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method ReservationCoach|null find($id, $lockMode = null, $lockVersion = null)
 * @method ReservationCoach|null findOneBy(array $criteria, array $orderBy = null)
 * @method ReservationCoach[]    findAll()
 * @method ReservationCoach[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ReservationCoachRepository extends ServiceEntityRepository
{
    private $findReservation;

    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ReservationCoach::class);
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function add(ReservationCoach $entity, bool $flush = true): void
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
    public function remove(ReservationCoach $entity, bool $flush = true): void
    {
        $this->_em->remove($entity);
        if ($flush) {
            $this->_em->flush();
        }
    }
    public function findReservation($idCoach,$idParticipant,$date,$time)
    {
        return $this->createQueryBuilder('r')
            ->where('r.idParticipant =:idParticipant')
            ->andWhere('r.idCoach =:idCoach')
            ->andWhere('r.date =:date')
            ->setParameter('idCoach',$idCoach)
            ->setParameter('idParticipant',$idParticipant)
            ->setParameter('date',$date)
            ->getQuery()
            ->getResult()
            ;
    }
    // /**
    //  * @return ReservationCoach[] Returns an array of ReservationCoach objects
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
    public function findOneBySomeField($value): ?ReservationCoach
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
    public function etat($idCoach,$status){
        return $this->createQueryBuilder('r')
            ->where('r.idCoach =:id')
            ->andWhere('r.etat LIKE :status')
            ->setParameter('id', $idCoach)
            ->setParameter('status', $status)
            ->getQuery()
            ->getResult();
    }
    public function countR($idCoach,$etat){
        return $this->createQueryBuilder('r')
            ->select('count(r.idCoach)')
            ->where('r.idCoach =:id')
            ->andWhere('r.etat LIKE :status')
            ->setParameter('id', $idCoach)
            ->setParameter('status', $etat)
            ->getQuery()
            ->getSingleScalarResult();

    }

}
