<?php

namespace App\Repository;

use App\Entity\User;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Doctrine\Persistence\ManagerRegistry;
use PhpParser\Node\Scalar\String_;

/**
 * @method User|null find($id, $lockMode = null, $lockVersion = null)
 * @method User|null findOneBy(array $criteria, array $orderBy = null)
 * @method User[]    findAll()
 * @method User[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UserRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, User::class);
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function add(User $entity, bool $flush = true): void
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
    public function remove(User $entity, bool $flush = true): void
    {
        $this->_em->remove($entity);
        if ($flush) {
            $this->_em->flush();
        }
    }

    // /**
    //  * @return User[] Returns an array of User objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('u')
            ->andWhere('u.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('u.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */


    public function findOneByMailAddressAndPassword( User $user): ?User
    {
        return $this->createQueryBuilder('u')
            ->andWhere('u.mailAdress = :val')
            ->andWhere('u.password = :vall')
            ->setParameter('val', $user->getMailAdress())
            ->setParameter('vall', $user->getPassword())

            ->getQuery()
            ->getOneOrNullResult()
        ;
    }




    public function findallCoachs(){
        $query=$this->getEntityManager()
            ->createQuery('SELECT c FROM App\Entity\User c WHERE c.whoami=:whoami')
        ->setParameter('whoami','Coach');
        return $query->getResult();

}

    public function findalladmins(){
        $query=$this->getEntityManager()
            ->createQuery('SELECT c FROM App\Entity\User c WHERE c.whoami=:whoami')
            ->setParameter('whoami','Administrateur');
        return $query->getResult();

    }
    public function findallsportifs(){
        $query=$this->getEntityManager()
            ->createQuery('SELECT c FROM App\Entity\User c WHERE c.whoami=:whoami')
            ->setParameter('whoami','Sportif');
        return $query->getResult();

    }
    public function findallgerants(){
        $query=$this->getEntityManager()
            ->createQuery('SELECT c FROM App\Entity\User c WHERE c.whoami=:whoami')
            ->setParameter('whoami','Gérant');
        return $query->getResult();

    }


    public function findByNameUser($name,$who){
        $query=$this->getEntityManager()
            ->createQuery('SELECT c FROM App\Entity\User c WHERE
             c.nom Like :name or c.prenom Like :prenom or c.adresse Like :adresse or c.numTel Like :numTel
              or c.mailAdress Like :mailAdress or c.dateNaissance Like :dateNaissance
              or c.blocRaison Like :blocRaison and c.whoami Like :whoami')
            ->setParameter('name','%'.$name.'%')
            ->setParameter('prenom','%'.$name.'%')
            ->setParameter('adresse','%'.$name.'%')
            ->setParameter('numTel','%'.$name.'%')
            ->setParameter('mailAdress','%'.$name.'%')
            ->setParameter('dateNaissance','%'.$name.'%')
            ->setParameter('blocRaison','%'.$name.'%')
            ->setParameter('whoami','%'.$who.'%')

        ;


        return $query->getResult();
    }



    public function whosconnected(){
        $query=$this->getEntityManager()
            ->createQuery('SELECT c FROM App\Entity\User c WHERE
             c.isconnected = 1 ')

        ;


        return $query->getResult();
    }

}
