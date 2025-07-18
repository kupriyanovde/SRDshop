<?php

// src/Controller/ErrorController.php
namespace App\Controller;

use App\Controller\Traits\RenderWithCommonLayoutTrait;
use App\Service\CommonLayoutService;
use App\Service\Layout\LayoutService;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use App\Controller\Traits\RenderWithLayoutTrait;
use Twig\Environment;

class ErrorController extends AbstractController
{
    use RenderWithCommonLayoutTrait;

    #[Route('/error404', name: 'error_404')]
    public function show(CommonLayoutService $layoutService, Environment $twig): Response
    {
        return $this->renderWithLayout($layoutService, 'pages/error.html.twig', [

        ]);
    }
}
