<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class ThemesController
 * @package App\Controller
 */
class ThemesController extends AbstractController
{

    /**
     * @Route("/themes", name="themes")
     * @return Response
     */
    public function index() : Response
    {
        return $this->render('themes/index.html.twig', [
            'controller_name' => 'ThemesController',
        ]);
    }
}
