<?php

namespace App\Service\Module;

use App\Service\Contract\ModuleContentInterface;
use Twig\Environment;

class BannerModule implements ModuleContentInterface
{
    public function __construct(
        private Environment $twig
    ) {}

    public function getName(): string
    {
        return 'banner';
    }

    public function getStyles(): array
    {
        return [];
    }

    public function getScripts(): array
    {
        return [];
    }


    public function getContent(string $route, string $position): ?string
    {
        // Передаем данные в twig-шаблон
        return $this->twig->render('module/banner.html.twig', [
            // можно передать дополнительные данные, если нужно
        ]);
    }


}
