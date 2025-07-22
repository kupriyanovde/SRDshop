<?php

namespace App\Entity;

use App\Repository\GroupPictureRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: GroupPictureRepository::class)]
#[ORM\Table(name: 'group_picture')]
class GroupPicture
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer', options: ['comment' => 'Идентификатор группы картинок'])]
    private ?int $id = null;

    /**
     * Название группы (например, "Главная страница каталога", "Акции").
     */
    #[ORM\Column(type: 'string', length: 150, options: ['comment' => 'Название группы картинок'])]
    private string $name;

    /**
     * Картинка, относящаяся к этой группе.
     * Может быть null, если картинка не назначена.
     */
    #[ORM\ManyToOne(targetEntity: Picture::class)]
    #[ORM\JoinColumn(name: 'picture_id', referencedColumnName: 'id', nullable: true, onDelete: 'SET NULL')]
    private ?Picture $picture = null;

    // ----------------------------
    // Геттеры и сеттеры
    // ----------------------------

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
