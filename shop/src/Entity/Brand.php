<?php

namespace App\Entity;

use App\Repository\BrandRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: BrandRepository::class)]
#[ORM\Table(name: "brand")]
class Brand
{
    /**
     * Уникальный идентификатор бренда.
     */
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: "integer", options: ["comment" => "ID бренда"])]
    private ?int $id = null;

    /**
     * Краткое название бренда.
     */
    #[ORM\Column(type: "string", length: 50, unique: true, options: ["comment" => "Краткое название бренда"])]
    private ?string $alias = null;

    /**
     * Полное название.
     */
    #[ORM\Column(type: "string", length: 150, options: ["comment" => "Название бренда"])]
    private ?string $name = null;

    /**
     * Страна происхождения.
     */
    #[ORM\Column(type: "string", length: 50, options: ["comment" => "Страна бренда"])]
    private ?string $country = null;

    /**
     * Город.
     */
    #[ORM\Column(type: "string", length: 50, options: ["comment" => "Город бренда"])]
    private ?string $town = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    // Обычно сеттер для id не нужен, потому что это автоинкремент, удалю его

    public function getAlias(): ?string
    {
        return $this->alias;
    }

    public function setAlias(string $alias): static
    {
        $this->alias = $alias;

        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getCountry(): ?string
    {
        return $this->country;
    }

    public function setCountry(string $country): static
    {
        $this->country = $country;

        return $this;
    }

    public function getTown(): ?string
    {
        return $this->town;
    }

    public function setTown(string $town): static
    {
        $this->town = $town;

        return $this;
    }
}
