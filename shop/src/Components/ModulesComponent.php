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
    public array $extra_styles = [];
    public array $extra_scripts = [];

    public function __construct(
        private RequestStack $requestStack,
        private ModuleContentBuilder $contentBuilder
    ) {}

    public function mount(string $position = 'left'): void
    {
        $this->position = $position;

        $route = $this->requestStack->getCurrentRequest()?->attributes->get('_route') ?? '';

        $result = $this->contentBuilder->build($route, $position);

        $this->content = $result['html'];
        $this->extra_scripts = $result['scripts'];
        $this->extra_styles = $result['styles'];
    }
}
