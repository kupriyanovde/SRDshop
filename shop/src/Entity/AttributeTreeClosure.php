<?php

namespace App\Entity;

use App\Repository\AttributeTreeClosureRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * Таблица замыканий для дерева атрибутов.
 *
 * Хранит все пути от предков к потомкам,
 * включая длину пути (depth).
 * Позволяет быстро выполнять запросы к иерархии.
 */
#[ORM\Entity(repositoryClass: AttributeTreeClosureRepository::class)]
#[ORM\Table(name: 'attribute_tree_closure')]
class AttributeTreeClosure
{
    /**
     * Идентификатор предка.
     * Ссылается на узел дерева AttributeTree.
     */
    #[ORM\Id]
    #[ORM\ManyToOne(targetEntity: AttributeTree::class)]
    #[ORM\JoinColumn(name: 'ancestor_id', referencedColumnName: 'id', nullable: false, onDelete: 'CASCADE')]
    private AttributeTree $ancestor;

    /**
     * Идентификатор потомка.
     * Ссылается на узел дерева AttributeTree.
     */
    #[ORM\Id]
    #[ORM\ManyToOne(targetEntity: AttributeTree::class)]
    #[ORM\JoinColumn(name: 'descendant_id', referencedColumnName: 'id', nullable: false, onDelete: 'CASCADE')]
    private AttributeTree $descendant;

    /**
     * Глубина пути от предка к потомку.
     * 0 означает тот же узел (ancestor = descendant),
     * 1 — прямой потомок, 2 — потомок потомка и т.д.
     */
    #[ORM\Column(type: 'integer', options: ['comment' => 'Глубина пути от предка к потомку'])]
    private int $depth;

    public function __construct(AttributeTree $ancestor, AttributeTree $descendant, int $depth)
    {
        $this->ancestor = $ancestor;
        $this->descendant = $descendant;
        $this->depth = $depth;
    }

    public function getAncestor(): AttributeTree
    {
        return $this->ancestor;
    }

    public function setAncestor(AttributeTree $ancestor): static
    {
        $this->ancestor = $ancestor;
        return $this;
    }

    public function getDescendant(): AttributeTree
    {
        return $this->descendant;
    }

    public function setDescendant(AttributeTree $descendant): static
    {
        $this->descendant = $descendant;
        return $this;
    }

    public function getDepth(): int
    {
        return $this->depth;
    }

    public function setDepth(int $depth): static
    {
        $this->depth = $depth;
        return $this;
    }
}
