<?php

namespace App\Entity;

use App\Repository\ModelLinkRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ModelLinkRepository::class)]
#[ORM\Table(name: 'model_link')]
class ModelLink
{
    /**
     * Уникальный идентификатор связи.
     */
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private ?int $id = null;

    /**
     * Тип модели (например, легковые, автобусы и т.д.).
     */
    #[ORM\ManyToOne(targetEntity: ModelType::class)]
    #[ORM\JoinColumn(name: 'model_type_id', referencedColumnName: 'id', nullable: false, onDelete: 'CASCADE')]
    private ?ModelType $modelType = null;

    /**
     * Марка, связанная с типом модели.
     */
    #[ORM\ManyToOne(targetEntity: Mark::class)]
    #[ORM\JoinColumn(name: 'mark_id', referencedColumnName: 'id', nullable: false, onDelete: 'CASCADE')]
    private ?Mark $mark = null;

    /**
     * Документ, связанный с моделью (опционально).
     */
    #[ORM\ManyToOne(targetEntity: Doc::class)]
    #[ORM\JoinColumn(name: 'doc_id', referencedColumnName: 'id', nullable: true, onDelete: 'SET NULL')]
    private ?Doc $doc = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getModelType(): ?ModelType
    {
        return $this->modelType;
    }

    public function setModelType(?ModelType $modelType): static
    {
        $this->modelType = $modelType;
        return $this;
    }

    public function getMark(): ?Mark
    {
        return $this->mark;
    }

    public function setMark(?Mark $mark): static
    {
        $this->mark = $mark;
        return $this;
    }

    public function getDoc(): ?Doc
    {
        return $this->doc;
    }

    public function setDoc(?Doc $doc): static
    {
        $this->doc = $doc;
        return $this;
    }
}
