<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Entity\Picture;

/**
 * Тип модели техники/транспорта.
 */
#[ORM\Entity]
#[ORM\Table(name: "model_type")]
class ModelType
{
    /**
     * Уникальный идентификатор типа модели.
     */
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: "integer", options: ["comment" => "ID типа модели"])]
    private ?int $id = null;

    /**
     * Название типа модели (например, "Легковые автомобили").
     */
    #[ORM\Column(type: "string", length: 100, options: ["comment" => "Название типа модели"])]
    private ?string $name = null;

    /**
     * Картинка, связанная с типом модели.
     * ManyToOne: много типов могут ссылаться на одну картинку.
     */
    #[ORM\ManyToOne(targetEntity: Picture::class)]
    #[ORM\JoinColumn(name: "picture_id", referencedColumnName: "id", nullable: true, onDelete: "SET NULL")]
    private ?Picture $picture = null;

    // --- Геттеры и сеттеры ---

    public function getId(): ?int
    {
        return $this->id;
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
