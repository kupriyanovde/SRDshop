<?php

namespace App\Entity;

use App\Repository\ArticleRepository;
use Doctrine\ORM\Mapping as ORM;
use App\Entity\Brand;

#[ORM\Entity(repositoryClass: ArticleRepository::class)]
#[ORM\Table(name: 'article')]
#[ORM\HasLifecycleCallbacks]
class Article
{
    /**
     * Уникальный идентификатор записи каталожного номера.
     */
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer', options: ['comment' => 'ID каталожного номера'])]
    private int $id;

    /**
     * Исходный каталожный номер, сохранённый с оригинальным форматированием.
     * Пример: "45.678 9АБВ", "5320-1001234-10".
     */
    #[ORM\Column(type: 'string', length: 100, unique: true, options: ['comment' => 'Оригинальный каталожный номер'])]
    private string $article;

    /**
     * Нормализованное значение каталожного номера для поиска.
     * Удаляются неалфавитно-цифровые символы, приводится к нижнему регистру.
     * Пример: "456789абв", "5320100123410".
     */
    #[ORM\Column(type: 'string', length: 100, unique: true, options: ['comment' => 'Каталожный номер для поиска (нормализованный)'])]
    private string $articleSearch;

    /**
     * Ссылка на производителя, бренд к которому относится данный номер.
     */
    #[ORM\ManyToOne(targetEntity: Brand::class)]
    #[ORM\JoinColumn(name: 'brand_id', referencedColumnName: 'id', nullable: true, onDelete: 'SET NULL')]
    private ?Brand $origin = null;

    public function getId(): int
    {
        return $this->id;
    }

    public function getArticle(): string
    {
        return $this->article;
    }

    public function setArticle(string $article): self
    {
        $this->article = $article;
        $this->normalizeArticle(); // Автоматическая нормализация
        return $this;
    }

    public function getArticleSearch(): string
    {
        return $this->articleSearch;
    }

    public function setArticleSearch(string $articleSearch): self
    {
        $this->articleSearch = $articleSearch;
        return $this;
    }

    public function getOrigin(): ?Brand
    {
        return $this->origin;
    }

    public function setBrand(?Brand $brand): self
    {
        $this->origin = $brand;
        return $this;
    }

    /**
     * Автоматическая нормализация article → articleSearch.
     */
    #[ORM\PrePersist]
    #[ORM\PreUpdate]
    public function normalizeArticle(): void
    {
        $normalized = strtolower(preg_replace('/[^a-z0-9а-яё]/iu', '', $this->article));
        $this->articleSearch = $normalized;
    }
}
