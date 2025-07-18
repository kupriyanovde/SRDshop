<?php

// src/Controller/HomeController.php
namespace App\Controller;

use App\Controller\Traits\RenderWithCommonLayoutTrait;
use App\Service\CommonLayoutService;
use App\Service\Layout\LayoutService;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use App\Controller\Traits\RenderWithLayoutTrait;
use Twig\Environment;

class HomeController extends AbstractController
{
    use RenderWithCommonLayoutTrait;

    #[Route('/', name: 'home')]
    public function index(CommonLayoutService $layoutService, Environment $twig): Response
    {
        return $this->renderWithLayout($layoutService, 'pages/home.html.twig', [

        ]);
    }
}
