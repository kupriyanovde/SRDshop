<?php

namespace App\Entity;

use App\Repository\DocRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: DocRepository::class)]
#[ORM\Table(name: 'doc')]
class Doc
{
    /**
     * Уникальный идентификатор каталога.
     */
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer', options: ['comment' => 'ID каталога'])]
    private ?int $id = null;

    /**
     * Название каталога.
     */
    #[ORM\Column(type: 'string', length: 255, options: ['comment' => 'Название каталога'])]
    private ?string $name = null;

    /**
     * Модели, связанные с каталогом (например, строка, описание).
     */
    #[ORM\Column(type: 'string', length: 255, nullable: true, options: ['comment' => 'Модели в каталоге'])]
    private ?string $models = null;

    /**
     * Год выпуска каталога.
     */
    #[ORM\Column(type: 'integer', nullable: true, options: ['comment' => 'Год каталога'])]
    private ?int $year = null;

    /**
     * Связь с таблицей картинок (picture).
     */
    #[ORM\ManyToOne(targetEntity: Picture::class)]
    #[ORM\JoinColumn(name: 'picture_id', referencedColumnName: 'id', nullable: true, onDelete: 'SET NULL')]
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

    public function getModels(): ?string
    {
        return $this->models;
    }

    public function setModels(?string $models): static
    {
        $this->models = $models;
        return $this;
    }

    public function getYear(): ?int
    {
        return $this->year;
    }

    public function setYear(?int $year): static
    {
        $this->year = $year;
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
