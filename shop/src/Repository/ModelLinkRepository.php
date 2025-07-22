<?php

namespace App\Repository;

use App\Entity\ModelLink;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * Репозиторий для связи типов, марок и документов.
 *
 * @extends ServiceEntityRepository<ModelLink>
 *
 * @method ModelLink|null find($id, $lockMode = null, $lockVersion = null)
 * @method ModelLink|null findOneBy(array $criteria, array $orderBy = null)
 * @method ModelLink[]    findAll()
 * @method ModelLink[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ModelLinkRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ModelLink::class);
    }

    /**
     * Найти по типу модели и марке.
     *
     * @param int $modelTypeId
     * @param int $markId
     * @return ModelLink[]
     */
    public function findByTypeAndMark(int $modelTypeId, int $markId): array
    {
        return $this->createQueryBuilder('ml')
            ->andWhere('ml.modelType = :modelType')
            ->andWhere('ml.mark = :mark')
            ->setParameter('modelType', $modelTypeId)
            ->setParameter('mark', $markId)
            ->getQuery()
            ->getResult();
    }
}
