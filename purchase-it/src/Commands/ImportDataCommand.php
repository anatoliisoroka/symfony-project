<?php

declare(strict_types=1);

namespace App\Commands;

use App\Repository\CollectionRepository;
use App\Repository\ProductsRepository;
use App\Repository\OrdersRepository;
use App\Repository\PayoutsRepository;
use App\Repository\TransactionsRepository;
use App\Repository\FullfillmentOrderRepository;
use App\Repository\CustomerRepository;
use App\Repository\CustomerAddressRepository;
use App\Repository\LocationsRepository;
use App\Repository\ThemesRepository;
use App\Repository\GiftCardRepository;
use App\Repository\PoliciesRepository;
use App\Repository\UserRepository;
use Swiftmailer\Swift_Mailer;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

/**
 * Class ImportDataCommand
 * @package App\Commands
 */
final class ImportDataCommand extends AbstractCommand
{
    /** @var string */
    protected static $defaultName = 'importFromShopify';

    /**
     * ImportDataCommand constructor.
     * @param CollectionRepository $collectionRepository
     * @param ProductsRepository $productsRepository
     * @param OrdersRepository $ordersRepository
     * @param PayoutsRepository $payoutsRepository
     * @param TransactionsRepository $transactionsRepository
     * @param FullfillmentOrderRepository $fullfillmentOrderRepository
     * @param CustomerRepository $customerRepository
     * @param CustomerAddressRepository $customerAddressRepository
     * @param LocationsRepository $locationsRepository
     * @param ThemesRepository $themesRepository
     * @param GiftCardRepository $giftCardRepository
     * @param PoliciesRepository $policiesRepository
     * @param UserRepository $userRepository
     * @param EntityManagerInterface $entityManager
     * @param \Swift_Mailer $mailer
     * @param UserPasswordEncoderInterface $passwordEncoder
     */
    public function __construct(
        CollectionRepository $collectionRepository,
        ProductsRepository $productsRepository,
        OrdersRepository $ordersRepository,
        PayoutsRepository $payoutsRepository,
        TransactionsRepository $transactionsRepository,
        FullfillmentOrderRepository $fullfillmentOrderRepository,
        CustomerRepository $customerRepository,
        CustomerAddressRepository $customerAddressRepository,
        LocationsRepository $locationsRepository,
        ThemesRepository $themesRepository,
        GiftCardRepository $giftCardRepository,
        PoliciesRepository $policiesRepository,
        UserRepository $userRepository,
        EntityManagerInterface $entityManager,
        \Swift_Mailer $mailer,
        UserPasswordEncoderInterface $passwordEncoder
    ) 
    {
        parent::__construct();
        $this->commands = [
            // new ImportCollectionData($collectionRepository, $entityManager),
            // new ImportProductData($productsRepository, $entityManager),
            new ImportCustomerData($customerRepository, $userRepository, $entityManager, $passwordEncoder, $mailer),
            new ImportOrderData($ordersRepository, $customerRepository, $passwordEncoder, $entityManager),
            // new ImportPayoutData($payoutsRepository, $entityManager),
            // new ImportTransactionData($transactionsRepository, $entityManager),
            // new ImportFulfillmentOrderData($fullfillmentOrderRepository, $entityManager),
            // new ImportCustomerAddressData($customerAddressRepository, $entityManager),
            // new ImportLocationData($locationsRepository, $entityManager),
            // new ImportThemeData($themesRepository, $entityManager),
            // new ImportGiftCardData($giftCardRepository, $entityManager),
            // new ImportPolicyData($policiesRepository, $entityManager)
            
        ];
    }

    /**
     *
     */
    protected function configure(): void
    {
        $this->setDescription('Imports  data from shopify.');
    }
}
