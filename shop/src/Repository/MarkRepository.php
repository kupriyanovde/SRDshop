<?php

namespace App\Repository;

use App\Entity\Mark;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * Репозиторий для работы с марками.
 *
 * @extends ServiceEntityRepository<Mark>
 *
 * @method Mark|null find($id, $lockMode = null, $lockVersion = null)
 * @method Mark|null findOneBy(array $criteria, array $orderBy = null)
 * @method Mark[]    findAll()
 * @method Mark[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MarkRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Mark::class);
    }

    /**
     * Найти марку по идентификатору.
     *
     * @param int $id
     * @return Mark|null
     */
    public function findOneById(int $id): ?Mark
    {
        return $this->find($id);
    }

    /**
     * Найти марку по алиасу.
     *
     * @param string $alias
     * @return Mark|null
     */
    public function findOneByAlias(string $alias): ?Mark
    {
        return $this->findOneBy(['alias' => $alias]);
    }
}
