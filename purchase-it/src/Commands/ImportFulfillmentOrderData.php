<?php

declare(strict_types=1);

namespace App\Commands;

use App\Entity\FullfillmentOrder;
use App\Repository\FullfillmentOrderRepository;
use DateTimeImmutable;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use function count;
use function in_array;
use function array_push;
use function strval;

/**
 * Class ImportFulfillmentOrderData
 * @package App\Commands
 */
final class ImportFulfillmentOrderData implements Command
{
    /**@var FullfillmentOrderRepository */
    private $fullfillmentOrderRepository;

    /**@var EntityManagerInterface */
    private $entityManager;

    /**
     * ImportFulfillmentOrderData constructor.
     * @param FullfillmentOrderRepository $fullfillmentOrderRepository
     * @param EntityManagerInterface $entityManager
     */
    public function __construct(FullfillmentOrderRepository $fullfillmentOrderRepository, EntityManagerInterface $entityManager)
    {
        $this->fullfillmentOrderRepository = $fullfillmentOrderRepository;
        $this->entityManager = $entityManager;
    }

    /**
     *
     */
    public function up(): void
    {
        $this->importFulfillmentOrderData($this->entityManager);
    }

    /**
     * @param $entityManager
     */
    private function importFulfillmentOrderData($entityManager): void
    {
        $url = 'https://ecd027e7165870006ff21f58e278c3fc:d11a55a65c712f779df5f28f551a4a89@thirty-six-purchase-it.myshopify.com/admin/api/2020-01/orders.json';
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $result = json_decode(curl_exec($ch));
        curl_close($ch);
        $independentOrderIds = [];
        foreach($result->orders as $order){
            if (in_array($order->id, $independentOrderIds)){
                continue;
            }
            else{
                array_push($independentOrderIds, $order->id);
            }      
        }
        foreach($independentOrderIds as $orderItem){
            $url1 = 'https://ecd027e7165870006ff21f58e278c3fc:d11a55a65c712f779df5f28f551a4a89@thirty-six-purchase-it.myshopify.com/admin/api/2020-01/orders/'.$orderItem.'/fulfillment_orders.json';
            $ch1 = curl_init($url1);
            curl_setopt($ch1, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
            curl_setopt($ch1, CURLOPT_RETURNTRANSFER, true);
            $result1 = json_decode(curl_exec($ch1));
            curl_close($ch1);
            $existingFulfillmentOrders = $this->fullfillmentOrderRepository->findAll();
            if(count($existingFulfillmentOrders) == 0){
                $fulfillmentOrderRecord = new FullfillmentOrder();
                $this->setParametersForFulfillmentOrder($result1, $fulfillmentOrderRecord, $entityManager, 1);
            }
            else{
                $isExist = false;
                foreach($existingFulfillmentOrders as $existingFulfillmentOrder){
                    if($existingFulfillmentOrder->getFullfillmentId() == $result1->fulfillment_orders[0]->id){
                        $isExist = true; 
                        $id = $existingFulfillmentOrder->getId();
                        $fulfillmentOrderRecord = $this->fullfillmentOrderRepository->find($id);
                        break;
                    }
                    else{
                        $isExist = false;
                    }                    
                }
                if($isExist){   
                    $this->setParametersForFulfillmentOrder($result1, $fulfillmentOrderRecord, $entityManager, 2);
                }
                else{
                    $fulfillmentOrderRecord = new FullfillmentOrder();
                    $this->setParametersForFulfillmentOrder($result1, $fulfillmentOrderRecord, $entityManager, 1);
                }

            }
        }
            
    }

    /**
     * @param $value
     * @param $fulfillmentOrderRecord
     * @param $entityManager
     * @param $ifUpdateOrInsert
     * @throws \Exception
     */
    public function setParametersForFulfillmentOrder($value, $fulfillmentOrderRecord, $entityManager, $ifUpdateOrInsert): void
    {
        $fulfillmentOrderRecord->setFullfillmentId(strval($value->fulfillment_orders[0]->id));
        $fulfillmentOrderRecord->setShopId(strval($value->fulfillment_orders[0]->shop_id));
        $fulfillmentOrderRecord->setOrderId(strval($value->fulfillment_orders[0]->order_id));
        $fulfillmentOrderRecord->setAssignedLocationId(strval($value->fulfillment_orders[0]->assigned_location_id));
        $fulfillmentOrderRecord->setFulfillmentServiceHandle($value->fulfillment_orders[0]->fulfillment_service_handle);
        $fulfillmentOrderRecord->setRequestStatus($value->fulfillment_orders[0]->request_status);
        $fulfillmentOrderRecord->setSupportedActions($value->fulfillment_orders[0]->supported_actions);
        $fulfillmentOrderRecord->setDestination($value->fulfillment_orders[0]->destination);
        $fulfillmentOrderRecord->setLineItems($value->fulfillment_orders[0]->line_items);
        $fulfillmentOrderRecord->setAssignedLocation($value->fulfillment_orders[0]->assigned_location);
        $fulfillmentOrderRecord->setMerchantRequests($value->fulfillment_orders[0]->merchant_requests);
        if($ifUpdateOrInsert == 1){
            $fulfillmentOrderRecord->setInsertByCustomerAt(new DateTimeImmutable());
        } 
        else if($ifUpdateOrInsert == 2){
            $fulfillmentOrderRecord->setUpdateByCustomerAt(new DateTimeImmutable()); 
        } 
        // tell Doctrine you want to (eventually) save the Product (no queries yet)
        $entityManager->persist($fulfillmentOrderRecord);
        // actually executes the queries (i.e. the INSERT query)
        $entityManager->flush();
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return 'Import fulfillmentOrder data';
    }
}
