<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class LocationController
 * @package App\Controller
 */
class LocationController extends AbstractController
{


    /**
     * @Route("/location", name="location")
     * @return Response
     */
    public function index() : Response
    {
        return $this->render('location/index.html.twig', [
            'controller_name' => 'LocationController',
        ]);
    }
}
