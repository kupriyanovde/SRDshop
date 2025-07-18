<?php

namespace App\Repository;

use App\Entity\LayoutModule;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class LayoutModuleRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, LayoutModule::class);
    }

    /**
     * Возвращает модули, связанные с маршрутом и позицией, отсортированные по position и sortOrder.
     *
     * @param string $route
     * @param string|null $position
     * @return LayoutModule[]
     */
    public function findByRouteAndPosition(string $route, ?string $position = null): array
    {
        $qb = $this->createQueryBuilder('lp')
            ->innerJoin('lp.layout', 'l')
            ->innerJoin('l.routes', 'lr')
            ->where('lr.route = :route')
            ->setParameter('route', $route);

        if ($position !== null) {
            $qb->andWhere('lp.position = :position')
                ->setParameter('position', $position);
        }

        $qb->orderBy('lp.position', 'ASC')
            ->addOrderBy('lp.sortOrder', 'ASC');

        return $qb->getQuery()->getResult();
    }
}
