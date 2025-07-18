<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: "layout_route")]
class LayoutRoute
{
    /**
     * Уникальный идентификатор маршрута.
     */
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: "integer")]
    private ?int $id = null;

    /**
     * Имя маршрута Symfony, к которому привязан макет (например: "app_homepage").
     */
    #[ORM\Column(type: "string", length: 255)]
    private string $route;

    /**
     * Макет, к которому относится этот маршрут.
     * Связь многие-к-одному (один макет может быть назначен нескольким маршрутам).
     */
    #[ORM\ManyToOne(targetEntity: Layout::class, inversedBy: "routes")]
    #[ORM\JoinColumn(nullable: false)]
    private Layout $layout;

    // --- Геттеры / Сеттеры ---

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getRoute(): string
    {
        return $this->route;
    }

    public function setRoute(string $route): self
    {
        $this->route = $route;
        return $this;
    }

    public function getLayout(): Layout
    {
        return $this->layout;
    }

    public function setLayout(Layout $layout): self
    {
        $this->layout = $layout;
        return $this;
    }
}
