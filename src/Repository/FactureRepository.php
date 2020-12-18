<?php

namespace App\Repository;

use App\Entity\Facture;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Facture|null find($id, $lockMode = null, $lockVersion = null)
 * @method Facture|null findOneBy(array $criteria, array $orderBy = null)
 * @method Facture[]    findAll()
 * @method Facture[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class FactureRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Facture::class);
    }



    /**
     * @return Facture[] Returns an array of Facture objects
     */

    public function countFacture()
    {
        return $this->createQueryBuilder('f')
            ->select('count(f.id)')
            ->getQuery()
            ->getSingleScalarResult()
            ;
    }


    public function countFactureNoPaye()
    {
        return $this->createQueryBuilder('c')
            ->select('count(c.id)')
            ->andWhere('c.statut = :val')
            ->setParameter('val', 0)
            ->getQuery()
            ->getSingleScalarResult()
            ;
    }

    public function countFacturePaye()
    {
        return $this->createQueryBuilder('c')
            ->select('count(c.id)')
            ->andWhere('c.statut = :val')
            ->setParameter('val', 1)
            ->getQuery()
            ->getSingleScalarResult()
            ;
    }


    /**
     * @return Facture[] Returns an array of Facture objects
     */
    public function countFactureByMonth()
    {
        return $this->createQueryBuilder('c')
            ->select('count(c.id) as count,MONTH(c.dateFacturation) as byMonth')
            ->groupBy('byMonth')
            ->getQuery()
            ->getOneOrNullResult()
            ;
    }

    /**
     * @return Facture[] Returns an array of facture objects
     */
    public function findFacturesByUtilisateur($value)
    {
        return $this->createQueryBuilder('f')
//            ->select('c')
            ->andWhere('f.utilisateur = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getResult()
            ;
    }


    // /**
    //  * @return Facture[] Returns an array of Facture objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('f')
            ->andWhere('f.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('f.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Facture
    {
        return $this->createQueryBuilder('f')
            ->andWhere('f.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
