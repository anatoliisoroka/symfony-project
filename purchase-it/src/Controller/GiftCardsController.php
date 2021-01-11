<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class GiftCardsController extends AbstractController
{


    /**
     * @Route("/gift/cards", name="gift_cards")
     * @return Response
     */
    public function index() : Response
    {
        return $this->render('gift_cards/index.html.twig', [
            'controller_name' => 'GiftCardsController',
        ]);
    }
}
