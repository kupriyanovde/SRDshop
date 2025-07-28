<?php

namespace App\Entity\Product;

use App\Repository\Product\AttributeRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * Сущность атрибута детали.
 *
 * Атрибуты используются для описания характеристик деталей и могут быть организованы в дерево.
 */
#[ORM\Entity(repositoryClass: AttributeRepository::class)]
#[ORM\Table(name: 'attribute')]
class Attribute
{
    /**
     * Уникальный идентификатор атрибута.
     */
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer', options: ['comment' => 'ID атрибута'])]
    private ?int $id = null;

    /**
     * Название атрибута.
     * Например: "Цвет", "Материал", "Диаметр".
     */
    #[ORM\Column(type: 'string', length: 50, options: ['comment' => 'Название атрибута'])]
    private string $name;

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
        return $this;
    }
}
