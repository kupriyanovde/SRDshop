<?php

namespace App\Entity;

use App\Repository\DetailNameRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: DetailNameRepository::class)]
#[ORM\Table(name: 'detail_name')]
#[ORM\HasLifecycleCallbacks]
class DetailName
{
    /**
     * Уникальный идентификатор названия детали.
     */
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer', options: ['comment' => 'ID детали'])]
    private ?int $id = null;

    /**
     * Оригинальное название детали.
     */
    #[ORM\Column(type: 'string', length: 255, options: ['comment' => 'Название детали'])]
    private string $name;

    /**
     * Нормализованное название (используется для поиска).
     */
    #[ORM\Column(type: 'string', length: 255, options: ['comment' => 'Название для поиска'])]
    private string $nameSearch;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;
        $this->updateNameSearch();
        return $this;
    }

    public function getNameSearch(): string
    {
        return $this->nameSearch;
    }

    public function setNameSearch(string $nameSearch): static
    {
        $this->nameSearch = $nameSearch;
        return $this;
    }

    /**
     * Автоматическая нормализация названия при сохранении сущности.
     */
    #[ORM\PrePersist]
    #[ORM\PreUpdate]
    public function updateNameSearch(): void
    {
        $normalized = strtolower(preg_replace('/[^a-z0-9а-яё]/iu', '', $this->name));
        $this->nameSearch = $normalized;
    }
}
