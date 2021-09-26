<?php

namespace App\Repository;

use App\Entity\Product;
use App\Entity\User;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Product|null find($id, $lockMode = null, $lockVersion = null)
 * @method Product|null findOneBy(array $criteria, array $orderBy = null)
 * @method Product[]    findAll()
 * @method Product[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProductRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Product::class);
    }

    /**
     * @return Product[] Returns an array of Product objects
     */
    
    public function findByUser(User $user)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.seller = :val')
            ->setParameter('val', $user)
            ->orderBy('p.id', 'ASC')
            ->getQuery()
            ->getResult()
        ;
    }

    public function findOnSale()
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.isOnSale = :val')
            ->setParameter('val', true)
            ->orderBy('p.id', 'ASC')
            ->getQuery()
            ->getResult()
        ;
    }


    public function findOnSaleByUser($user)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.isOnSale = :onSale')
            ->andWhere('p.seller = :user')
            ->setParameter('onSale', true)
            ->setParameter('user', $user)
            ->orderBy('p.id', 'ASC')
            ->getQuery()
            ->getResult()
        ;
    }
}