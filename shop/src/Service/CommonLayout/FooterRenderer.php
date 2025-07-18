<?php

// src/Service/CommonLayout/FooterRenderer.php
namespace App\Service\CommonLayout;

use App\Service\Contract\CommonLayoutContentInterface;
use Twig\Environment;

class FooterRenderer implements CommonLayoutContentInterface
{
    public function __construct(private Environment $twig) {}

    public function getKey(): string
    {
        return 'footer';
    }

    public function render(): string
    {
        return $this->twig->render('common/footer.html.twig');
    }
}
