<?php

namespace App\Repository;

use App\Entity\CourSalle;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method CourSalle|null find($id, $lockMode = null, $lockVersion = null)
 * @method CourSalle|null findOneBy(array $criteria, array $orderBy = null)
 * @method CourSalle[]    findAll()
 * @method CourSalle[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CourSalleRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CourSalle::class);
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function add(CourSalle $entity, bool $flush = true): void
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
    public function remove(CourSalle $entity, bool $flush = true): void
    {
        $this->_em->remove($entity);
        if ($flush) {
            $this->_em->flush();
        }
    }

    // /**
    //  * @return CourSalle[] Returns an array of CourSalle objects
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
    public function findOneBySomeField($value): ?CourSalle
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */

    public function findBySalle($value)
    {
        return $this->createQueryBuilder('c')
            ->where('c.Utilisateur = :val')
            ->setParameter('val', $value)
            ->orderBy('c.id', 'ASC')
            ->getQuery()
            ->getResult()
            ;
    }
    public function findSalleTrie($id,$by,$trie)
    {
        return $this->createQueryBuilder('c')
            ->where('c.Utilisateur = :id')
            ->setParameter('id', (int)$id)

            ->orderBy($by, $trie)
            ->getQuery()
            ->getResult()
            ;
    }
    public function nomSalleLike($data){
        return $this->createQueryBuilder('c')
            ->join('c.Utilisateur','u')
            ->addSelect('u')
            ->where('u.nom LIKE :data')
            ->andWhere('u.whoami =:salle')
            ->setParameter('data', '%'.$data.'%')
            ->setParameter('salle', 'salle')
            ->getQuery()
            ->getResult();
    }
    public function nomCourLike($data){
        return $this->createQueryBuilder('c')
            ->where('c.nomCour LIKE :data')
            ->setParameter('data', '%'.$data.'%')
            ->getQuery()
            ->getResult();
    }
    public function dateCourLike($data){
        return $this->createQueryBuilder('c')
            ->where('c.date LIKE :data')
            ->setParameter('data', '%'.$data.'%')
            ->getQuery()
            ->getResult();
    }
    public function heureCourLike($data){
        return $this->createQueryBuilder('c')
            ->where('c.tCour LIKE :data')
            ->setParameter('data', '%'.$data.'%')
            ->getQuery()
            ->getResult();
    }
}
