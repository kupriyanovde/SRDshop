<?php

namespace App\Repository;

use App\Entity\Brand;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * Репозиторий для работы с брендами.
 *
 * @extends ServiceEntityRepository<Brand>
 *
 * @method Brand|null find($id, $lockMode = null, $lockVersion = null)
 * @method Brand|null findOneBy(array $criteria, array $orderBy = null)
 * @method Brand[]    findAll()
 * @method Brand[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BrandRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Brand::class);
    }

    /**
     * Найти бренд по идентификатору.
     *
     * @param int $id
     * @return Brand|null
     */
    public function findOneById(int $id): ?Brand
    {
        return $this->find($id);
    }

    /**
     * Найти бренд по краткому названию (alias).
     *
     * @param string $alias
     * @return Brand|null
     */
    public function findOneByAlias(string $alias): ?Brand
    {
        return $this->findOneBy(['alias' => $alias]);
    }

    /**
     * Найти бренды по части названия (name).
     *
     * @param string $partName
     * @return Brand[]
     */
    public function findByNamePart(string $partName): array
    {
        return $this->createQueryBuilder('b')
            ->where('b.name LIKE :name')
            ->setParameter('name', '%'.$partName.'%')
            ->orderBy('b.name', 'ASC')
            ->getQuery()
            ->getResult();
    }
}
