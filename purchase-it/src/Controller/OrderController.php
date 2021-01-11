<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use App\Repository\CustomerRepository;
use App\Repository\OrdersRepository;

/**
 * Class OrderController
 * @package App\Controller
 */
class OrderController extends AbstractController
{

    private $session;

    /**@var CustomerRepository */
    private $customerRepository;

    /**@var OrdersRepository */
    private $ordersRepository;

    /**
     * OrderController constructor.
     * @param SessionInterface $session
     * @param CustomerRepository $customerRepository
     * @param OrdersRepository $ordersRepository
     */
    public function __construct(
        SessionInterface $session, 
        CustomerRepository $customerRepository,
        OrdersRepository $ordersRepository
    )
    {
        $this->session = $session;
        $this->customerRepository = $customerRepository;
        $this->ordersRepository = $ordersRepository;
    }


    /**
     * @Route("/order", name="order")
     * @return Response
     */
    public function index() : Response
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
        $user = $this->getUser();
        $customerId = $user->getCustomer()->getCustomerId();
        $fromDate =  $this->session->get('fromDate');
        $toDate =  $this->session->get('toDate');
        if(!$fromDate){
            $fromDate = "1970-01-01";
        }
        if(!$toDate){
            $toDate = date('Y-m-d');
        }
        $orders = $this->ordersRepository
                ->findOrdersByFilters($customerId, date("Y-m-d", strtotime($fromDate)), date("Y-m-d", strtotime($toDate)));
        
        
        return $this->render('order/index.html.twig', [
            'controller_name' => 'OrderController',
            'orders' => $orders,
            'fromDate' => $this->session->get('fromDate'),
            'toDate' => $this->session->get('toDate')
        ]);
    }

    /**
     * @Route("/orders", name="orders")
     * @return Response
     */
    public function getAllOrders() : Response
    {
        $allOrders = $this->ordersRepository
                ->findAll();
        return $this->render('order/allOrders.html.twig', [
            'allOrders' => $allOrders
        ]);
    }

    /**
     * @Route("/order/setfilter", name="setFilter", methods={"POST"})
     * @param Request $request
     * @return RedirectResponse
     */
    public function setSessionFilter(Request $request) : RedirectResponse
    {
        $fromDate = $request->request->get('from');
        $toDate = $request->request->get('to');
        $this->session->set('fromDate', $fromDate);
        $this->session->set('toDate', $toDate);

        return $this->redirectToRoute('order');
    }

    /**
     * @Route("/order/resetfilter", name="resetFilter", methods={"GET"})
     * @return RedirectResponse
     */
    public function reSetFilter() : RedirectResponse
    {
        $this->session->remove('fromDate');
        $this->session->remove('toDate');
        return $this->redirectToRoute('order');
    }
}
