<?php

namespace App\Repository;

use App\Entity\Produit;
use App\Entity\ProduitSearch;
use App\Entity\PropertySearch;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Doctrine\ORM\Query;
use Doctrine\ORM\QueryBuilder;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bridge\Doctrine\RegistryInterface;
use Symfony\Component\HttpFoundation\Response;
use function PHPUnit\Framework\assertGreaterThan;

/**
 * @method Produit|null find($id, $lockMode = null, $lockVersion = null)
 * @method Produit|null findOneBy(array $criteria, array $orderBy = null)
 * @method Produit[]    findAll()
 * @method Produit[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProduitRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Produit::class);
    }


    public function findVisibleQuery():QueryBuilder
    {
        return $this->createQueryBuilder('p')
        ->where('p.prix=false');
    }

    //
    //

    /**
     * @return Query
     */
    public function findAllVisibleQuery(propertySearch $search)
    {


        $searching = $this->createQueryBuilder('Produit')
            ->andWhere('Produit.description LIKE :searchDescription')
            ->setParameter('searchDescription', '%'. $search->getDescription() .'%' )


            ->getQuery()
            ->execute();
        return ($searching);
    }

    public function findByPriceRange($minValue,$maxValue)
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.prix >= :minVal')
            ->setParameter('minVal', $minValue)
            ->andWhere('a.prix <= :maxVal')
            ->setParameter('maxVal', $maxValue)
            ->orderBy('a.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
            ;
    }

    /**
     * @return Produit[]
     */
    public function findLatest():array
    {
        return $this->findVisibleQuery()
            ->setMaxResult(4)
            ->getQuery()
            ->getResult();
    }


    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function add(Produit $entity, bool $flush = true): void
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
    public function remove(Produit $entity, bool $flush = true): void
    {
        $this->_em->remove($entity);
        if ($flush) {
            $this->_em->flush();
        }
    }



    // /**
    //  * @return Produit[] Returns an array of Produit objects
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
    public function findOneBySomeField($value): ?Produit
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
     * Returns num of produits par category
     * @return void
     */
    public function countByCat(){
        return $this->createQueryBuilder('c')
            ->addSelect('count(c.category) AS sum')

            ->groupBy('c.category')
            ->getQuery()
            ->getResult()
            ;
    }

}
