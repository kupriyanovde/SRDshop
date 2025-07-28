<?php

namespace App\Entity\Product;

use App\Repository\Product\AttributeTreeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Узел дерева атрибутов.
 *
 * Используется для построения иерархии атрибутов (например, группы и подгруппы атрибутов).
 */
#[ORM\Entity(repositoryClass: AttributeTreeRepository::class)]
#[ORM\Table(name: 'attribute_tree')]
class AttributeTree
{
    /**
     * Уникальный идентификатор узла дерева.
     */
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer', options: ['comment' => 'ID узла дерева атрибутов'])]
    private ?int $id = null;

    /**
     * Название узла (атрибута или группы атрибутов).
     */
    #[ORM\Column(type: 'string', length: 100, options: ['comment' => 'Название узла атрибутов'])]
    private string $name;

    /**
     * Родительский узел дерева.
     * Nullable для корневых элементов.
     */
    #[ORM\ManyToOne(targetEntity: self::class, inversedBy: 'children')]
    #[ORM\JoinColumn(name: 'parent_id', referencedColumnName: 'id', nullable: true, onDelete: 'SET NULL')]
    private ?self $parent = null;

    /**
     * Дочерние узлы.
     *
     * @var Collection|self[]
     */
    #[ORM\OneToMany(mappedBy: 'parent', targetEntity: self::class, cascade: ['persist', 'remove'])]
    private Collection $children;

    public function __construct()
    {
        $this->children = new ArrayCollection();
    }

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

    public function getParent(): ?self
    {
        return $this->parent;
    }

    public function setParent(?self $parent): static
    {
        $this->parent = $parent;
        return $this;
    }

    /**
     * @return Collection|self[]
     */
    public function getChildren(): Collection
    {
        return $this->children;
    }

    /**
     * Добавляет дочерний узел к этому узлу.
     */
    public function addChild(self $child): static
    {
        if (!$this->children->contains($child)) {
            $this->children->add($child);
            $child->setParent($this);
        }
        return $this;
    }

    /**
     * Удаляет дочерний узел из этого узла.
     */
    public function removeChild(self $child): static
    {
        if ($this->children->removeElement($child)) {
            if ($child->getParent() === $this) {
                $child->setParent(null);
            }
        }
        return $this;
    }
}
