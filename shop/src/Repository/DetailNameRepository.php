<?php

namespace App\Repository;

use App\Entity\DetailName;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<DetailName>
 *
 * @method DetailName|null find($id, $lockMode = null, $lockVersion = null)
 * @method DetailName|null findOneBy(array $criteria, array $orderBy = null)
 * @method DetailName[]    findAll()
 * @method DetailName[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DetailNameRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, DetailName::class);
    }

    /**
     * Найти деталь по идентификатору.
     *
     * @param int $id
     * @return DetailName|null
     */
    public function findOneById(int $id): ?DetailName
    {
        return $this->find($id);
    }

    /**
     * Поиск по нормализованному названию детали (nameSearch).
     *
     * @param string $input Ввод пользователя или название в произвольном формате
     * @return DetailName|null
     */
    public function findByNormalizedName(string $input): ?DetailName
    {
        $normalized = $this->normalize($input);

        return $this->findOneBy(['nameSearch' => $normalized]);
    }

    /**
     * Нормализация названия: удаление не-буквенно-цифровых символов, приведение к нижнему регистру.
     *
     * @param string $input
     * @return string
     */
    private function normalize(string $input): string
    {
        return strtolower(preg_replace('/[^a-z0-9а-яё]/iu', '', $input));
    }
}
