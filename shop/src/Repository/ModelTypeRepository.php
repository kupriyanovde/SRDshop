<?php

namespace App\Repository;

use App\Entity\ModelType;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * Репозиторий для работы с типами моделей.
 *
 * @extends ServiceEntityRepository<ModelType>
 *
 * @method ModelType|null find($id, $lockMode = null, $lockVersion = null)
 * @method ModelType|null findOneBy(array $criteria, array $orderBy = null)
 * @method ModelType[]    findAll()
 * @method ModelType[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ModelTypeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ModelType::class);
    }

    /**
     * Найти тип модели по идентификатору.
     *
     * @param int $id
     * @return ModelType|null
     */
    public function findOneById(int $id): ?ModelType
    {
        return $this->find($id);
    }

    /**
     * Найти тип модели по названию.
     *
     * @param string $name
     * @return ModelType|null
     */
    public function findOneByName(string $name): ?ModelType
    {
        return $this->findOneBy(['name' => $name]);
    }
}
