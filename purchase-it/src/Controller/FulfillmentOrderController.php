<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class FulfillmentOrderController
 * @package App\Controller
 */
class FulfillmentOrderController extends AbstractController
{

    /**
     * @Route("/fulfillment/order", name="fulfillment_order")
     * @return Response
     */
    public function index() : Response
    {
        return $this->render('fulfillment_order/index.html.twig', [
            'controller_name' => 'FulfillmentOrderController',
        ]);
    }
}
