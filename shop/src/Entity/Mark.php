<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Entity\Picture;

/**
 * Марка (бренд/марка техники или товара).
 */
#[ORM\Entity]
#[ORM\Table(name: "mark")]
class Mark
{
    /**
     * Уникальный идентификатор марки.
     */
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: "integer", options: ["comment" => "ID марки"])]
    private ?int $id = null;

    /**
     * Уникальный краткий идентификатор.
     */
    #[ORM\Column(type: "string", length: 50, unique: true, options: ["comment" => "Краткое название марки"])]
    private ?string $alias = null;

    /**
     * Название марки.
     */
    #[ORM\Column(type: "string", length: 150, options: ["comment" => "Название марки"])]
    private ?string $name = null;

    /**
     * Картинка, связанная с маркой.
     * ManyToOne: много марок могут ссылаться на одну картинку.
     */
    #[ORM\ManyToOne(targetEntity: Picture::class)]
    #[ORM\JoinColumn(name: "picture_id", referencedColumnName: "id", nullable: true, onDelete: "SET NULL")]
    private ?Picture $picture = null;

    // --- Геттеры и сеттеры ---

    public function getId(): ?int
    {
        return $this->id;
    }

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

    public function getPicture(): ?Picture
    {
        return $this->picture;
    }

    public function setPicture(?Picture $picture): static
    {
        $this->picture = $picture;
        return $this;
    }
}
