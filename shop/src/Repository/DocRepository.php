<?php

namespace App\Repository;

use App\Entity\Doc;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * Репозиторий для работы с каталогами (Doc).
 *
 * @extends ServiceEntityRepository<Doc>
 *
 * @method Doc|null find($id, $lockMode = null, $lockVersion = null)
 * @method Doc|null findOneBy(array $criteria, array $orderBy = null)
 * @method Doc[]    findAll()
 * @method Doc[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DocRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Doc::class);
    }

    /**
     * Найти каталоги по году.
     *
     * @param int $year
     * @return Doc[]
     */
    public function findByYear(int $year): array
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.year = :year')
            ->setParameter('year', $year)
            ->orderBy('d.name', 'ASC')
            ->getQuery()
            ->getResult();
    }
}
