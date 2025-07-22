<?php

namespace App\Repository;

use App\Entity\GroupTree;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * Репозиторий для работы с деревом GroupTree.
 *
 * @extends ServiceEntityRepository<GroupTree>
 *
 * @method GroupTree|null find($id, $lockMode = null, $lockVersion = null)
 * @method GroupTree|null findOneBy(array $criteria, array $orderBy = null)
 * @method GroupTree[]    findAll()
 * @method GroupTree[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class GroupTreeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, GroupTree::class);
    }

    /**
     * Получить полный путь от корня до узла по его ID.
     *
     * @param int $nodeId
     * @return GroupTree[]
     */
    public function findFullPath(int $nodeId): array
    {
        $qb = $this->_em->createQueryBuilder();

        $qb->select('ancestor')
            ->from(GroupTree::class, 'ancestor')
            ->innerJoin('App\Entity\GroupTreeClosure', 'closure', 'WITH', 'closure.ancestor = ancestor.id')
            ->where('closure.descendant = :nodeId')
            ->orderBy('closure.depth', 'ASC')
            ->setParameter('nodeId', $nodeIdno);

        return $qb->getQuery()->getResult();
    }

    /**
     * Получить всех потомков узла с указанным ID.
     *
     * @param int $nodeId
     * @return GroupTree[]
     */
    public function findDescendants(int $nodeId): array
    {
        $qb = $this->_em->createQueryBuilder();

        $qb->select('descendant')
            ->from(GroupTree::class, 'descendant')
            ->innerJoin('App\Entity\GroupTreeClosure', 'closure', 'WITH', 'closure.descendant = descendant.id')
            ->where('closure.ancestor = :nodeId')
            ->orderBy('closure.depth', 'ASC')
            ->setParameter('nodeId', $nodeId);

        return $qb->getQuery()->getResult();
    }
}
