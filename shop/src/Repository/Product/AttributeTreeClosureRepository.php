<?php

namespace App\Repository\Product;

use App\Entity\Product\AttributeTree;
use App\Entity\Product\AttributeTreeClosure;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<AttributeTreeClosure>
 *
 * @method AttributeTreeClosure|null find($id, $lockMode = null, $lockVersion = null)
 * @method AttributeTreeClosure|null findOneBy(array $criteria, array $orderBy = null)
 * @method AttributeTreeClosure[]    findAll()
 * @method AttributeTreeClosure[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AttributeTreeClosureRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, AttributeTreeClosure::class);
    }

    /**
     * Получить путь от корня до указанного узла (включительно), отсортированный по глубине.
     *
     * @param AttributeTree $node
     * @return AttributeTree[] Массив сущностей AttributeTree
     */
    public function findPathToNode(AttributeTree $node): array
    {
        $qb = $this->createQueryBuilder('closure')
            ->select('ancestor')
            ->innerJoin('closure.ancestor', 'ancestor')
            ->andWhere('closure.descendant = :node')
            ->setParameter('node', $node)
            ->orderBy('closure.depth', 'ASC');

        $result = $qb->getQuery()->getResult();

        return $result;
    }

    /**
     * Получить всех потомков указанного узла (включительно), отсортированных по глубине.
     *
     * @param AttributeTree $node
     * @return AttributeTree[] Массив сущностей AttributeTree
     */
    public function findDescendants(AttributeTree $node): array
    {
        $qb = $this->createQueryBuilder('closure')
            ->select('descendant')
            ->innerJoin('closure.descendant', 'descendant')
            ->andWhere('closure.ancestor = :node')
            ->setParameter('node', $node)
            ->orderBy('closure.depth', 'ASC');

        $result = $qb->getQuery()->getResult();

        return $result;
    }
}
