<?php

namespace App\Service\Module;

use App\Service\Contract\ModuleContentInterface;
use Twig\Environment;

class AboutBannerModule implements ModuleContentInterface
{
    public function __construct(
        private Environment $twig
    ) {}

    public function getName(): string
    {
        return 'about_banner';
    }

    public function getStyles(): array
    {
        return ['assets/css/module/about_banner.css'];
    }

    public function getScripts(): array
    {
        return [];
    }

    public function getContent(string $route, string $position): ?string
    {
        // Передаем данные в twig-шаблон
        return $this->twig->render('module/about_banner.html.twig', [
            // можно передать дополнительные данные, если нужно
        ]);
    }


}
