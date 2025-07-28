<?php

// src/Controller/ErrorController.php
namespace App\Controller\Services;

use App\Controller\Traits\RenderWithCommonLayoutTrait;
use App\Controller\Traits\RenderWithLayoutTrait;
use App\Service\CommonLayoutService;
use App\Service\Layout\LayoutService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Twig\Environment;

class JournalController extends AbstractController
{
    use RenderWithCommonLayoutTrait;

    #[Route('/service/journal', name: 'service-journal')]
    public function show(CommonLayoutService $layoutService, Environment $twig): Response
    {
        return $this->renderWithLayout($layoutService, 'pages/error.html.twig', [

        ]);
    }
}
