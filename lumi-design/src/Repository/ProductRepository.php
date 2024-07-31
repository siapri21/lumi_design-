<?php

namespace App\Repository;

use App\Entity\Product;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\QueryBuilder;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Product>
 */
class ProductRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Product::class);
    }

    //    /**
    //     * @return Product[] Returns an array of Product objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('p')
    //            ->andWhere('p.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('p.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

       public function findOneBySomeField(string $slug): ?Product
       {
           return $this->createQueryBuilder('p')
               ->leftJoin('p.category','c')
               ->addSelect('c')
               ->andWhere('p.slug = :slug')
               ->setParameter('slug', $slug)
               ->getQuery()
               ->getOneOrNullResult()
           ;
       }

    //    public function findAllSortedByUpdatedAt(): QueryBuilder
    //    {
    //        return $this->createQueryBuilder('p')
    //            ->orderBy('p.updatedAt', 'DESC')
    //            ->leftJoin('p.category', 'c')
    //            ->addSelect('c');
    //    }
   
}
