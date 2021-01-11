<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class PolicyController
 * @package App\Controller
 */
class PolicyController extends AbstractController
{

    /**
     * @Route("/policy", name="policy")
     * @return Response
     */
    public function index() : Response
    {
        return $this->render('policy/index.html.twig', [
            'controller_name' => 'PolicyController',
        ]);
    }
}
