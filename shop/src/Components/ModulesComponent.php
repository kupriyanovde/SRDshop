<?php

namespace App\Components;

use App\Service\ModuleContentBuilder;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\UX\TwigComponent\Attribute\AsTwigComponent;

#[AsTwigComponent('modules')]
class ModulesComponent
{
    public string $position = 'left';
    public array $content = [];

    public function __construct(
        private RequestStack $requestStack,
        private ModuleContentBuilder $contentBuilder
    ) {}

    public function mount(string $position = 'left'): void
    {
        $this->position = $position;

        $route = $this->requestStack->getCurrentRequest()?->attributes->get('_route') ?? '';

        $this->content = $this->contentBuilder->build($route, $position);
    }
}
