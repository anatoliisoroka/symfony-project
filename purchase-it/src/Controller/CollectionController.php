<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use function count;
use function in_array;
use function array_push;
use function strval;

/**
 * Class CollectionController
 * @package App\Controller
 */
class CollectionController extends AbstractController
{

    /**
     * @Route("/collection", name="collection")
     * @return Response
     */
    public function index() : Response
    {
        // $url = 'https://ecd027e7165870006ff21f58e278c3fc:d11a55a65c712f779df5f28f551a4a89@thirty-six-purchase-it.myshopify.com/admin/api/2020-01/policies.json';
        // $ch = curl_init($url);
        // curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
        // curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        // $result = json_decode(curl_exec($ch));
        // curl_close($ch);
        
        // return new JsonResponse (explode("/",$result->policies[0]->url)[5]);
        //return new JsonResponse($result->policies[0]->url);
        
        return $this->render('collection/index.html.twig', [
            'controller_name' => 'CollectionController',
        ]);
    }
}
