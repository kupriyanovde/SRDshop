<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: GroupTreeClosureRepository::class)]
#[ORM\Table(name: 'group_tree_closure')]
class GroupTreeClosure
{
    #[ORM\Id]
    #[ORM\ManyToOne(targetEntity: GroupTree::class, inversedBy: 'closureDescendants')]
    #[ORM\JoinColumn(name: 'ancestor_id', referencedColumnName: 'id', onDelete: 'CASCADE')]
    private GroupTree $ancestor;

    #[ORM\Id]
    #[ORM\ManyToOne(targetEntity: GroupTree::class, inversedBy: 'closureParents')]
    #[ORM\JoinColumn(name: 'descendant_id', referencedColumnName: 'id', onDelete: 'CASCADE')]
    private GroupTree $descendant;

    /**
     * Глубина связи (расстояние) между предком и потомком.
     * 0 — это сам узел,
     * 1 — непосредственный потомок,
     * 2 — потомок второго уровня и т.д.
     */
    #[ORM\Column(type: 'integer')]
    private int $depth;

    public function getAncestor(): GroupTree
    {
        return $this->ancestor;
    }

    public function setAncestor(GroupTree $ancestor): static
    {
        $this->ancestor = $ancestor;
        return $this;
    }

    public function getDescendant(): GroupTree
    {
        return $this->descendant;
    }

    public function setDescendant(GroupTree $descendant): static
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
