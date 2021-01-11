<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class PayoutController
 * @package App\Controller
 */
class PayoutController extends AbstractController
{

    /**
     * @Route("/payout", name="payout")
     * @return Response
     */
    public function index() : Response
    {
        return $this->render('payout/index.html.twig', [
            'controller_name' => 'PayoutController',
        ]);
    }
}
