<?php

namespace App\Repository;

use App\Entity\LayoutModule;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * Репозиторий для работы с модулями макета.
 *
 * @extends ServiceEntityRepository<LayoutModule>
 *
 * @method LayoutModule|null find($id, $lockMode = null, $lockVersion = null)
 * @method LayoutModule|null findOneBy(array $criteria, array $orderBy = null)
 * @method LayoutModule[]    findAll()
 * @method LayoutModule[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class LayoutModuleRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, LayoutModule::class);
    }

    /**
     * Возвращает модули, связанные с маршрутом и (опционально) позицией,
     * отсортированные по позиции и порядку сортировки.
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

        return $qb
            ->orderBy('lp.position', 'ASC')
            ->addOrderBy('lp.sortOrder', 'ASC')
            ->getQuery()
            ->getResult();
    }
}
