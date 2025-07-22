<?php

namespace App\Repository;

use App\Entity\GroupTreeClosure;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * Репозиторий для работы с Closure Table дерева групп.
 *
 * @extends ServiceEntityRepository<GroupTreeClosure>
 *
 * @method GroupTreeClosure|null find($id, $lockMode = null, $lockVersion = null)
 * @method GroupTreeClosure|null findOneBy(array $criteria, array $orderBy = null)
 * @method GroupTreeClosure[]    findAll()
 * @method GroupTreeClosure[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class GroupTreeClosureRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, GroupTreeClosure::class);
    }

    /**
     *
     * Получить путь от корня к узлу по имени узла.
     *
     * @param string $nodeName
     * @return array<string> Массив имён узлов от корня к узлу
     */
    public function findPathFromRootByNodeName(string $nodeName): array
    {
        $qb = $this->createQueryBuilder('c')
            ->select('ancestor.name AS name', 'c.depth')
            ->innerJoin('App\Entity\GroupTree', 'ancestor', 'WITH', 'ancestor.id = c.ancestor')
            ->innerJoin('App\Entity\GroupTree', 'descendant', 'WITH', 'descendant.id = c.descendant')
            ->where('descendant.name = :nodeName')
            ->setParameter('nodeName', $nodeName)
            ->orderBy('c.depth', 'ASC');

        $results = $qb->getQuery()->getResult();

        return array_map(fn($r) => $r['name'], $results);
    }

    /**
     * Получить путь от узла к корню по имени узла (обратный путь).
     *
     * @param string $nodeName
     * @return array<string> Массив имён узлов от узла к корню
     */
    public function findPathToRootByNodeName(string $nodeName): array
    {
        $qb = $this->createQueryBuilder('c')
            ->select('descendant.name AS name', 'c.depth')
            ->innerJoin('App\Entity\GroupTree', 'ancestor', 'WITH', 'ancestor.id = c.ancestor')
            ->innerJoin('App\Entity\GroupTree', 'descendant', 'WITH', 'descendant.id = c.descendant')
            ->where('ancestor.name = :nodeName')
            ->setParameter('nodeName', $nodeName)
            ->orderBy('c.depth', 'DESC');

        $results = $qb->getQuery()->getResult();

        return array_map(fn($r) => $r['name'], $results);
    }
}
