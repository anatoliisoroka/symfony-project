<?php

declare(strict_types=1);

namespace App\Commands;

use App\Entity\Orders;
use App\Entity\Customer;
use App\Entity\User;
use App\Repository\OrdersRepository;
use App\Repository\CustomerRepository;
use DateTimeImmutable;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use function count;
use function in_array;
use function array_push;
use function strval;

/**
 * Class ImportOrderData
 * @package App\Commands
 */
final class ImportOrderData implements Command
{
    /**@var OrdersRepository */
    private $ordersRepository;

    /**@var CustomerRepository */
    private $customerRepository;

    /**@var UserPasswordEncoderInterface */
    private $passwordEncoder;

    /**@var EntityManagerInterface */
    private $entityManager;

    /**
     * ImportOrderData constructor.
     * @param OrdersRepository $ordersRepository
     * @param CustomerRepository $customerRepository
     * @param UserPasswordEncoderInterface $passwordEncoder
     * @param EntityManagerInterface $entityManager
     */
    public function __construct(
        OrdersRepository $ordersRepository,
        CustomerRepository $customerRepository, 
        UserPasswordEncoderInterface $passwordEncoder,
        EntityManagerInterface $entityManager
    )
    {
        $this->ordersRepository = $ordersRepository;
        $this->customerRepository = $customerRepository;
        $this->entityManager = $entityManager;
        $this->passwordEncoder = $passwordEncoder;
    }

    /**
     *
     */
    public function up(): void
    {
        $this->importOrderData($this->entityManager);
    }

    /**
     * @param $entityManager
     */
    private function importOrderData($entityManager): void
    {
        $url = 'https://ecd027e7165870006ff21f58e278c3fc:d11a55a65c712f779df5f28f551a4a89@thirty-six-purchase-it.myshopify.com/admin/api/2020-01/orders.json';
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $result = json_decode(curl_exec($ch));
        curl_close($ch);
        foreach($result->orders as $order){
            $existingOrders = $this->ordersRepository->findAll();
            if(count($existingOrders) == 0){
                $orderRecord = new Orders();
                $realCustomerId = $order->customer->id;
                $customerRecord = $this->customerRepository->findByCustomerId(strval($realCustomerId));
                $this->setParametersForOrder($order, $orderRecord, $entityManager, 1, $customerRecord, $order->customer);
            }
            else{
                $isExist = false;
                foreach($existingOrders as $existingOrder){
                    if($existingOrder->getOrderId() == $order->id){
                        $isExist = true; 
                        $id = $existingOrder->getId();
                        $orderRecord = $this->ordersRepository->find($id);
                        $realCustomerId = $order->customer->id;
                        $customerRecord = $this->customerRepository->findByCustomerId(strval($realCustomerId));
                        break;
                    }
                    else{
                        $isExist = false;
                    }                    
                }
                if($isExist){   
                    $this->setParametersForOrder($order, $orderRecord, $entityManager, 2, $customerRecord, $order->customer);
                }
                else{
                    $orderRecord = new Orders();
                    $realCustomerId = $order->customer->id;
                    $customerRecord = $this->customerRepository->findByCustomerId(strval($realCustomerId));
                    $this->setParametersForOrder($order, $orderRecord, $entityManager, 1, $customerRecord, $order->customer);
                }

            }
        }
                
    }

    /**
     * @param $value
     * @param $orderRecord
     * @param $entityManager
     * @param $ifUpdateOrInsert
     * @param $customerRecord
     * @param $customerInOrder
     * @throws \Exception
     */
    public function setParametersForOrder(
        $value, 
        $orderRecord, 
        $entityManager,
        $ifUpdateOrInsert, 
        $customerRecord,
        $customerInOrder
    ): void
    {
        
        if($customerRecord){
            $realCustomerRecord = $customerRecord;
            $orderRecord->setOrderId(strval($value->id));
            $orderRecord->setRealCustomerId(strval($value->customer->id));
            $orderRecord->setEmail($value->email);
            $orderRecord->setClosedAt($value->closed_at);
            $orderRecord->setCreatedAt(new DateTimeImmutable($value->created_at));
            $orderRecord->setUpdatedAt(new DateTimeImmutable($value->updated_at));
            $orderRecord->setNumber($value->number);
            $orderRecord->setNote($value->note);
            $orderRecord->setToken($value->token);
            $orderRecord->setGateway($value->gateway);
            $orderRecord->setTotalPrice($value->total_price);
            $orderRecord->setSubtotalPrice($value->subtotal_price);
            $orderRecord->setTotalWeight(strval($value->total_weight));
            $orderRecord->setTotalTax(strval($value->total_tax));
            $orderRecord->setTaxesIncluded(true);
            $orderRecord->setCurrency($value->currency);
            $orderRecord->setFinancialStatus($value->financial_status);
            $orderRecord->setConfirmed($value->confirmed);
            $orderRecord->setTotalDiscounts($value->total_discounts);
            $orderRecord->setTotalLineItemsPrice($value->total_line_items_price);
            $orderRecord->setCartToken($value->cart_token);
            $orderRecord->setBuyerAcceptsMarketing($value->buyer_accepts_marketing);
            $orderRecord->setName($value->name);
            $orderRecord->setReferringSite($value->referring_site);
            $orderRecord->setLandingSite($value->landing_site);
            $orderRecord->setCancelledAt($value->cancelled_at);
            $orderRecord->setCancelReason($value->cancel_reason);
            $orderRecord->setTotalPriceUsd($value->total_price_usd);
            $orderRecord->setCheckoutToken($value->checkout_token);
            $orderRecord->setUserId(strval($value->user_id));
            $orderRecord->setLocationId($value->location_id);
            $orderRecord->setSourceIdentifier($value->source_identifier);
            $orderRecord->setSourceUrl($value->source_url);
            $orderRecord->setProcessedAt(new DateTimeImmutable($value->processed_at));
            $orderRecord->setDiviceId($value->device_id);
            $orderRecord->setPhone($value->phone);
            $orderRecord->setCustomerLocale($value->customer_locale);
            $orderRecord->setAppId(strval($value->app_id));
            $orderRecord->setBrowserIp($value->browser_ip);
            $orderRecord->setOrderNumber($value->order_number);
            $orderRecord->setDiscountApplications($value->discount_applications);
            $orderRecord->setDiscountCodes($value->discount_codes);
            $orderRecord->setNoteAttributes($value->note_attributes);
            $orderRecord->setProcessingMethod($value->processing_method);
            $orderRecord->setCheckoutId(strval($value->checkout_id));
            $orderRecord->setSourceName($value->source_name);
            $orderRecord->setFullfillmentStatus($value->fulfillment_status);
            $orderRecord->setTaxLines($value->tax_lines);
            $orderRecord->setTags($value->tags);
            $orderRecord->setContactEmail($value->contact_email);
            $orderRecord->setOrderStatusUrl($value->order_status_url);
            $orderRecord->setPresentmentCurrency($value->presentment_currency);
            $orderRecord->setTotalLineItemsPriceSet($value->total_line_items_price_set);
            $orderRecord->setTotalDiscountsSet($value->total_discounts_set);
            $orderRecord->setTotalShippingPriceSet($value->total_shipping_price_set);
            $orderRecord->setSubtotalPriceSet($value->subtotal_price_set);
            $orderRecord->setTotalPriceMoney($value->total_price_set);
            $orderRecord->setTotalTaxSet($value->total_tax_set);
            $orderRecord->setLineItems($value->line_items);
            $orderRecord->setFulfillments($value->fulfillments);
            $orderRecord->setRefunds($value->refunds);
            $orderRecord->setTotalTipReceived($value->total_tip_received);
            $orderRecord->setAdminGraphqlApiId($value->admin_graphql_api_id);
            $orderRecord->setShippingLines($value->shipping_lines);
            $orderRecord->setBillingAddress($value->billing_address);
            $orderRecord->setShippingAddress($value->shipping_address);
            $orderRecord->setClientDetails($value->client_details);

            $orderRecord->setCustomer($realCustomerRecord);

            if($ifUpdateOrInsert == 1){
                $orderRecord->setInsertByCustomerAt(new DateTimeImmutable());
            } 
            else if($ifUpdateOrInsert == 2){
                $orderRecord->setUpdateByCustomerAt(new DateTimeImmutable()); 
            } 
            $entityManager->persist($orderRecord);
        }
        else
        {
            $newCustomerRecord = new Customer();
            $userRecord = new User();
            $newCustomerRecord->setCustomerId(strval($customerInOrder->id));
            $newCustomerRecord->setAcceptsMarketing($customerInOrder->accepts_marketing);
            $newCustomerRecord->setUser($userRecord);
            $newCustomerRecord->setCreatedAt(new DateTimeImmutable($customerInOrder->created_at));
            $newCustomerRecord->setUpdatedAt(new DateTimeImmutable($customerInOrder->updated_at));
            $newCustomerRecord->setOrdersCount($customerInOrder->orders_count);
            $newCustomerRecord->setState($customerInOrder->state);
            $newCustomerRecord->setTotalSpent($customerInOrder->total_spent);
            $newCustomerRecord->setLastOrderId(strval($customerInOrder->last_order_id));
            $newCustomerRecord->setNote($customerInOrder->note);
            $newCustomerRecord->setVerifiedEmail($customerInOrder->verified_email);
            $newCustomerRecord->setMiltipassIdentifier($customerInOrder->multipass_identifier);
            $newCustomerRecord->setTaxExampt($customerInOrder->tax_exempt);
            $newCustomerRecord->setPhone($customerInOrder->phone);
            $newCustomerRecord->setTags($customerInOrder->tags);
            $newCustomerRecord->setLastOrderName($customerInOrder->last_order_name);
            $newCustomerRecord->setCurrency($customerInOrder->currency);
            //$newCustomerRecord->setAddresses($customerInOrder->addresses);
            $newCustomerRecord->setAcceptsMarketingUpdatedAt(new DateTimeImmutable($customerInOrder->accepts_marketing_updated_at));
            $newCustomerRecord->setMarketingOptInLevel($customerInOrder->marketing_opt_in_level);
            //$newCustomerRecord->setTaxExemptions($customerInOrder->tax_exemptions);
            $newCustomerRecord->setAdminGraphqlApiId($customerInOrder->admin_graphql_api_id);

            $userRecord->setEmail($customerInOrder->email);
            $userRecord->setRoles(['ROLE_CUSTOMER']);
            $userRecord->setPassword($this->passwordEncoder->encodePassword(
                $userRecord,
                'the_new_password'
            ));
            $userRecord->setFirstName($customerInOrder->first_name);
            $userRecord->setLastName($customerInOrder->last_name);
            $newCustomerRecord->setInsertByCustomerAt(new DateTimeImmutable());
            $entityManager->persist($newCustomerRecord);
            $entityManager->persist($userRecord);
        }
        
        //$entityManager->persist($realCustomerRecord);
        $entityManager->flush();
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return 'Import order data';
    }
}