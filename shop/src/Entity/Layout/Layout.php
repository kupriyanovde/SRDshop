<?php

namespace App\Entity\Layout;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: "layout")]
class Layout
{
    /**
     * Уникальный идентификатор макета страницы.
     */
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: "integer")]
    private ?int $id = null;

    /**
     * Название (системное имя) макета, например: "main_layout", "landing_page", "product_detail".
     */
    #[ORM\Column(type: "string", length: 32)]
    private string $name;

    /**
     * Модули (баннеры, карты и т.д.), назначенные этому макету.
     * Связь: Один макет — много модулей.
     */
    #[ORM\OneToMany(
        targetEntity: LayoutModule::class,
        mappedBy: "layout",
        cascade: ["persist", "remove"],
        orphanRemoval: true
    )]
    private Collection $modules;

    /**
     * Привязка маршрутов (роутов) к макету.
     * Связь: Один макет — много маршрутов.
     */
    #[ORM\OneToMany(
        targetEntity: LayoutRoute::class,
        mappedBy: "layout",
        cascade: ["persist", "remove"],
        orphanRemoval: true
    )]
    private Collection $routes;

    public function __construct()
    {
        $this->modules = new ArrayCollection();
        $this->routes = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return Collection|LayoutModule[]
     */
    public function getModules(): Collection
    {
        return $this->modules;
    }

    public function addModule(LayoutModule $module): self
    {
        if (!$this->modules->contains($module)) {
            $this->modules[] = $module;
            $module->setLayout($this);
        }
        return $this;
    }

    /**
     * @return Collection|LayoutRoute[]
     */
    public function getRoutes(): Collection
    {
        return $this->routes;
    }

    public function addRoute(LayoutRoute $route): self
    {
        if (!$this->routes->contains($route)) {
            $this->routes[] = $route;
            $route->setLayout($this);
        }
        return $this;
    }
}
