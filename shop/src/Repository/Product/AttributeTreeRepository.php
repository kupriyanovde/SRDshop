<?php

namespace App\Repository\Product;

use App\Entity\Product\AttributeTree;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<AttributeTree>
 *
 * @method AttributeTree|null find($id, $lockMode = null, $lockVersion = null)
 * @method AttributeTree|null findOneBy(array $criteria, array $orderBy = null)
 * @method AttributeTree[]    findAll()
 * @method AttributeTree[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AttributeTreeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, AttributeTree::class);
    }
}
