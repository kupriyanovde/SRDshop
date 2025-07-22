<?php

namespace App\Repository;

use App\Entity\GroupPicture;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<GroupPicture>
 *
 * Репозиторий для работы с сущностью GroupPicture.
 */
class GroupPictureRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, GroupPicture::class);
    }

    /**
     * Найти группу по названию.
     *
     * @param string $name Название группы
     * @return GroupPicture|null
     */
    public function findOneByName(string $name): ?GroupPicture
    {
        return $this->findOneBy(['name' => $name]);
    }

    /**
     * Получить все группы с заданной картинкой.
     *
     * @param int $pictureId Идентификатор картинки
     * @return GroupPicture[]
     */
    public function findByPictureId(int $pictureId): array
    {
        return $this->createQueryBuilder('gp')
            ->andWhere('gp.picture = :pictureId')
            ->setParameter('pictureId', $pictureId)
            ->orderBy('gp.name', 'ASC')
            ->getQuery()
            ->getResult();
    }

    /**
     * Получить все группы, отсортированные по названию.
     *
     * @return GroupPicture[]
     */
    public function findAllOrderedByName(): array
    {
        return $this->createQueryBuilder('gp')
            ->orderBy('gp.name', 'ASC')
            ->getQuery()
            ->getResult();
    }
}
