<?php

namespace App\Repository;
use App\Entity\Exercice;

use App\Entity\Programme;
use App\Entity\RechercheExercice;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\Query;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Exercice|null find($id, $lockMode = null, $lockVersion = null)
 * @method Exercice|null findOneBy(array $criteria, array $orderBy = null)
 * @method Exercice[]    findAll()
 * @method Exercice[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ExerciceRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Exercice::class);
    }
    public function findAllWithPagination() : Query{
        return $this->createQueryBuilder('e')
        ->getQuery();

    }


    
    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function add(Exercice $entity, bool $flush = true): void
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
    public function remove(Exercice $entity, bool $flush = true): void
    {
        
        $this->_em->remove($entity);
        if ($flush) {
            $this->_em->flush();
        }
    }

    // /**
    //  * @return Exercice[] Returns an array of Exercice objects
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
    public function findOneBySomeField($value): ?Exercice
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */


/**
     * @return Query
     */
    public function findAllVisibleQuery(RechercheExercice $search)
    {
        //     $query = $this->findVisibleQuery();
        //     if ($search->getMaxprice()) {
        //         $query = $query->where('p.price <= :maxprice')
        //             ->setParameter('maxprice', $search->getMaxprice());
        //     }

        //     return $query->getQuery();

        $searching = $this->createQueryBuilder('Exercice')
            ->andWhere('Exercice.nomExercice LIKE :searchNom')
            ->setParameter('searchNom', '%'. $search->getRechercheNom() .'%' )

            ->andWhere('Exercice.categorieExercice LIKE :searchCategorie')
            ->setParameter('searchCategorie', '%'. $search->getRechercheCategorie() .'%' )

            ->getQuery()
            ->execute();
        return ($searching);
    }













}
