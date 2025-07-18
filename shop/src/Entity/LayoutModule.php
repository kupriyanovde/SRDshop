<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: "layout_module")]
class LayoutModule
{
    /**
     * Уникальный идентификатор модуля в макете.
     */
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: "integer")]
    private ?int $id = null;

    /**
     * Название модуля (системное имя), например: "banner6", "map", "featured_products".
     */
    #[ORM\Column(type: "string", length: 32)]
    private string $module;

    /**
     * Позиция модуля в макете — например: "top", "left", "right", "bottom".
     */
    #[ORM\Column(type: "string", length: 32)]
    private string $position;

    /**
     * Очередность отображения модуля среди других в той же позиции.
     */
    #[ORM\Column(type: "integer")]
    private int $sortOrder;

    /**
     * Макет, к которому принадлежит этот модуль.
     * Связь многие-к-одному (один макет — много модулей).
     */
    #[ORM\ManyToOne(targetEntity: Layout::class, inversedBy: "providers")]
    #[ORM\JoinColumn(nullable: false)]
    private Layout $layout;

    // --- Геттеры и сеттеры ---

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->module;
    }

    public function setName(string $moduleName): self
    {
        $this->module = $moduleName;
        return $this;
    }

    public function getPosition(): string
    {
        return $this->position;
    }

    public function setPosition(string $position): self
    {
        $this->position = $position;
        return $this;
    }

    public function getSortOrder(): int
    {
        return $this->sortOrder;
    }

    public function setSortOrder(int $sortOrder): self
    {
        $this->sortOrder = $sortOrder;
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
