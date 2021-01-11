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
 * Class AdminDashboardController
 * @package App\Controller
 */
class AdminDashboardController extends AbstractController
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
     * @Route("/admin/dashboard", name="adminDashboard")
     * @return Response
     */
    public function index() : Response
    {
        $allOrders = $this->ordersRepository->findAll();
        $customerId = $this->session->get('customerId');;
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
        return $this->render('dashboard/index.html.twig', [
            'today'=> date('Y-m-d', strtotime(date('Y-m-d').' +2 day')),
            'processedOrders' => $processedOrders,
            'unProcessedOrders' => $unProcessedOrders,
            'totalOrders' => $totalOrders,
            'salesNumbers' => $salesNumbers,
            'processedMoney' => $processedMoney,
            'unprocessedMoney' => $unprocessedMoney,
            'startDate' => $this->session->get('startDate'),
            'endDate' => $this->session->get('endDate'),
            'allOrders' =>$allOrders,
            'customerId' =>$this->session->get('customerId')
        ]);
    }

    /**
     * @Route("/admin/dashboard/setdate", name="setDateForAdmin", methods={"POST"})
     * @param Request $request
     * @return RedirectResponse
     */
    public function setSessionItems(Request $request) : RedirectResponse
    {
        $customerId = $request->request->get('customer');
        $startDate = $request->request->get('startDate');
        $endDate = $request->request->get('endDate');
        if(!$startDate){
            $startDate = date('Y-m-01');
        }
        if(!$endDate){
            $endDate = date('Y-m-d');
        }
        if(!$customerId){
            $customerId = '2917795561533';
        }
        $this->session->set('startDate', $startDate);
        $this->session->set('endDate', $endDate);
        $this->session->set('customerId', $customerId);

        return $this->redirectToRoute('adminDashboard');
    }

    /**
     * @Route("/admin/dashboard/resetdate", name="resetDateForAdmin", methods={"GET"})
     * @return RedirectResponse
     */
    public function reSetSessionItems() : RedirectResponse
    {
        $this->session->remove('startDate');
        $this->session->remove('endDate');
        $this->session->remove('customerId');
        return $this->redirectToRoute('adminDashboard');
    }
}
