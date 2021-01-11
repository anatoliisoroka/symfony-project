<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class TransactionController
 * @package App\Controller
 */
class TransactionController extends AbstractController
{

    /**
     * @Route("/transaction", name="transaction")
     * @return Response
     */
    public function index() : Response
    {
        return $this->render('transaction/index.html.twig', [
            'controller_name' => 'TransactionController',
        ]);
    }
}
