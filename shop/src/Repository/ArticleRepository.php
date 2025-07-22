<?php

namespace App\Repository;

use App\Entity\Article;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Article>
 *
 * @method Article|null find($id, $lockMode = null, $lockVersion = null)
 * @method Article|null findOneBy(array $criteria, array $orderBy = null)
 * @method Article[]    findAll()
 * @method Article[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ArticleRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Article::class);
    }

    /**
     * Найти артикул по идентификатору.
     *
     * @param int $id
     * @return Article|null
     */
    public function findOneById(int $id): ?Article
    {
        return $this->find($id);
    }

    /**
     * Поиск по нормализованному каталожному номеру (articleSearch).
     * Нормализация осуществляется как в сущности.
     *
     * @param string $input Ввод пользователя или номер в произвольном формате
     * @return Article|null
     */
    public function findByNormalizedArticle(string $input): ?Article
    {
        $normalized = $this->normalize($input);

        return $this->findOneBy(['articleSearch' => $normalized]);
    }

    /**
     * Нормализация номера: удаление не-буквенно-цифровых символов, приведение к нижнему регистру.
     *
     * @param string $input
     * @return string
     */
    private function normalize(string $input): string
    {
        // В сущности используется регулярка с поддержкой кириллицы,
        // поэтому здесь тоже лучше её использовать:
        return strtolower(preg_replace('/[^a-z0-9а-яё]/iu', '', $input));
    }

    /**
     * Найти все артикулы по бренду (brand).
     *
     * @param int $brandId
     * @return Article[]
     */
    public function findByBrandId(int $brandId): array
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.brand = :brandId')
            ->setParameter('brandId', $brandId)
            ->getQuery()
            ->getResult();
    }
}
