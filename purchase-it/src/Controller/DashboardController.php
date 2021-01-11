<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use App\Repository\CustomerRepository;
use App\Repository\OrdersRepository;

/**
 * Class DashboardController
 * @package App\Controller
 */
class DashboardController extends AbstractController
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
     * @Route("dashboard", name="dashboard")
     * @return Response
     */
    public function index() : Response
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
        $user = $this->getUser();
        $customerId = $user->getCustomer()->getCustomerId();
        $startDate =  $this->session->get('startDate');
        $endDate =  $this->session->get('endDate');
        $salesNumbers = 0;
        $processedMoney = 0;
        $totalMoney = 0;
        if(!$startDate){
            $startDate = date('Y-m-01');
        }
        if(!$endDate){
            $endDate = date('Y-m-d');
        }
        $processedOrders = $this->ordersRepository
                ->findProcessedOrdersByDate($customerId, date("Y-m-d", strtotime($endDate)));
        $unProcessedOrders = $this->ordersRepository
                ->findOrdersByFilters($customerId, date("Y-m-d", strtotime($endDate)), date("Y-m-d", strtotime(date('Y-m-d'))));
        $totalOrders = $this->ordersRepository
                ->findProcessedOrdersByDate($customerId, date("Y-m-d", strtotime(date('Y-m-d'))));
        foreach($processedOrders as $processedOrder){
            $salesNumbers++;
            $processedMoney += $processedOrder->getTotalPrice();
        }
        foreach($totalOrders as $order){
            $totalMoney += $order->getTotalPrice();
        }
        $unprocessedMoney = $totalMoney - $processedMoney;
        return $this->render('dashboard/customerDashboard.html.twig', [
            'today'=> date('Y-m-d', strtotime(date('Y-m-d').' +2 day')),
            'processedOrders' => $processedOrders,
            'unProcessedOrders' => $unProcessedOrders,
            'totalOrders' => $totalOrders,
            'salesNumbers' => $salesNumbers,
            'processedMoney' => $processedMoney,
            'unprocessedMoney' => $unprocessedMoney,
            'startDate' => $this->session->get('startDate'),
            'endDate' => $this->session->get('endDate')
        ]);
    }

    /**
     * @Route("/dashboard/setdate", name="setDate", methods={"POST"})
     * @param Request $request
     * @return RedirectResponse
     */
    public function setSessionDate(Request $request) : RedirectResponse
    {
        $startDate = $request->request->get('startDate');
        $endDate = $request->request->get('endDate');
        if(!$startDate){
            $startDate = date('Y-m-01');
        }
        if(!$endDate){
            $endDate = date('Y-m-d');
        }
        $this->session->set('startDate', $startDate);
        $this->session->set('endDate', $endDate);

        return $this->redirectToRoute('dashboard');
    }

    /**
     * @Route("/dashboard/resetdate", name="resetDate", methods={"GET"})
     * @return RedirectResponse
     */
    public function reSetDate() : RedirectResponse
    {
        $this->session->remove('startDate');
        $this->session->remove('endDate');
        return $this->redirectToRoute('dashboard');
    }
}
