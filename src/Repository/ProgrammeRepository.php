<?php

namespace App\Repository;

use Doctrine\ORM\Query;
use App\Entity\Programme;
use App\Entity\RechercheProgramme;
use Doctrine\ORM\ORMException;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;


/**
 * @method Programme|null find($id, $lockMode = null, $lockVersion = null)
 * @method Programme|null findOneBy(array $criteria, array $orderBy = null)
 * @method Programme[]    findAll()
 * @method Programme[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProgrammeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Programme::class);
    }

    public function findAllWithPagination() : Query{
        return $this->createQueryBuilder('p')
        ->getQuery();

    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function add(Programme $entity, bool $flush = true): void
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
    public function remove(Programme $entity, bool $flush = true): void
    {
        $this->_em->remove($entity);
        if ($flush) {
            $this->_em->flush();
        }
    }

    // /**
    //  * @return Programme[] Returns an array of Programme objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('p.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Programme
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */

/**
     * @return Query
     */
    public function findAllVisibleQuery(RechercheProgramme $search)
    {
        //     $query = $this->findVisibleQuery();
        //     if ($search->getMaxprice()) {
        //         $query = $query->where('p.price <= :maxprice')
        //             ->setParameter('maxprice', $search->getMaxprice());
        //     }

        //     return $query->getQuery();

        $searching = $this->createQueryBuilder('Programme')
            ->andWhere('Programme.nomProgramme LIKE :searchNom')
            ->setParameter('searchNom', '%'. $search->getRechercheProgNom() .'%' )

            ->andWhere('Programme.categorieProgramme LIKE :searchCategorie')
            ->setParameter('searchCategorie', '%'. $search->getRechercheProgCate() .'%' )

          /*   ->andWhere('Programme.objectifProgramme LIKE :searchObjectif')
            ->setParameter('searchCategorie', '%'. $search->getRechercheProgObj() .'%' )
 */
            ->getQuery()
            ->execute();
        return ($searching);
    }






}


