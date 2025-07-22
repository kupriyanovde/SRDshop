<?php

namespace App\Entity;

use App\Repository\PictureRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PictureRepository::class)]
#[ORM\Table(name: 'picture')]
class Picture
{
    /**
     * Уникальный идентификатор картинки.
     */
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer', options: ['comment' => 'ID картинки'])]
    private ?int $id = null;

    /**
     * Путь к файлу картинки.
     */
    #[ORM\Column(type: 'string', length: 255, options: ['comment' => 'Путь к файлу картинки'])]
    private ?string $path = null;

    /**
     * Атрибут alt для картинки.
     */
    #[ORM\Column(type: 'string', length: 255, nullable: true, options: ['comment' => 'Атрибут alt для картинки'])]
    private ?string $alt = null;

    /**
     * Атрибут title для картинки.
     */
    #[ORM\Column(type: 'string', length: 255, nullable: true, options: ['comment' => 'Атрибут title для картинки'])]
    private ?string $title = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPath(): ?string
    {
        return $this->path;
    }

    public function setPath(string $path): static
    {
        $this->path = $path;
        return $this;
    }

    public function getAlt(): ?string
    {
        return $this->alt;
    }

    public function setAlt(?string $alt): static
    {
        $this->alt = $alt;
        return $this;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(?string $title): static
    {
        $this->title = $title;
        return $this;
    }
}
