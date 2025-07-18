<?php

// src/Service/CommonLayout/HeaderRenderer.php
namespace App\Service\CommonLayout;

use App\Service\Contract\CommonLayoutContentInterface;
use Twig\Environment;

class HeaderRenderer implements CommonLayoutContentInterface
{
    public function __construct(private Environment $twig) {}

    public function getKey(): string
    {
        return 'header';
    }

    public function render(): string
    {
        return $this->twig->render('common/header.html.twig');
    }
}
