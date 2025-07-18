<?php

// src/Controller/Traits/RenderWithLayoutTrait.php
namespace App\Controller\Traits;

use App\Service\CommonLayoutService;
use Symfony\Component\HttpFoundation\Response;

trait RenderWithCommonLayoutTrait
{
    // Контроллер должен расширять AbstractController!
    private function renderWithLayout(
        CommonLayoutService $layoutService,
        string $template,
        array $parameters = []
    ): Response {
        $layout = $layoutService->getLayoutParts();
        return $this->render($template, array_merge($layout, $parameters));
    }
}
