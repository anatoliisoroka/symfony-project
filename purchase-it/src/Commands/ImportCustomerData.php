<?php

declare(strict_types=1);

namespace App\Commands;

use App\Entity\Customer;
use App\Entity\User;
use App\Repository\CustomerRepository;
use App\Repository\UserRepository;
use DateTimeImmutable;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Swiftmailer\Swift_Mailer;
use Symfony\Component\Mime\Email;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use function count;
use function in_array;
use function array_push;
use function strval;

/**
 * Class ImportCustomerData
 * @package App\Commands
 */
final class ImportCustomerData implements Command
{
    /**@var CustomerRepository */
    private $customerRepository;

    /**@var UserRepository */
    private $userRepository;

    /**@var UserPasswordEncoderInterface */
    private $passwordEncoder;

    /**@var \Swift_Mailer */
    private $mailer;

    /**@var EntityManagerInterface */
    private $entityManager;

    /**
     * ImportCustomerData constructor.
     * @param CustomerRepository $customerRepository
     * @param UserRepository $userRepository
     * @param EntityManagerInterface $entityManager
     * @param UserPasswordEncoderInterface $passwordEncoder
     * @param \Swift_Mailer $mailer
     */
    public function __construct(
        CustomerRepository $customerRepository, 
        UserRepository $userRepository,
        EntityManagerInterface $entityManager,
        UserPasswordEncoderInterface $passwordEncoder,
        \Swift_Mailer $mailer
    )
    {
        $this->customerRepository = $customerRepository;
        $this->userRepository = $userRepository;
        $this->entityManager = $entityManager;
        $this->passwordEncoder = $passwordEncoder;
        $this->mailer = $mailer;
    }

    /**
     *
     */
    public function up(): void
    {
        $this->importCustomerData($this->entityManager, $this->mailer);
    }

    /**
     * @param $entityManager
     * @param $mailer
     */
    private function importCustomerData($entityManager, $mailer): void
    {
        $url = 'https://ecd027e7165870006ff21f58e278c3fc:d11a55a65c712f779df5f28f551a4a89@thirty-six-purchase-it.myshopify.com/admin/api/2020-01/customers.json';
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $result = json_decode(curl_exec($ch));
        curl_close($ch);
        foreach($result->customers as $customer){
            $existingCustomers = $this->customerRepository->findAll();
            if(count($existingCustomers) == 0){
                $customerRecord = new Customer();
                $userRecord = new User();
                $userId = $userRecord->getId();
                $this->setParametersForCustomer($customer, $customerRecord, $entityManager, 1 ,$userRecord, $userId);
                $this->sendEmail($mailer, $customer);
            }
            else{
                $isExist = false;
                foreach($existingCustomers as $existingCustomer){
                    if($existingCustomer->getCustomerId() == $customer->id){
                        $isExist = true; 
                        $id = $existingCustomer->getId();
                        $customerRecord = $this->customerRepository->find($id);
                        $userRecord = $customerRecord->getUser();
                        $userId = $userRecord->getId();
                        break;
                    }
                    else{
                        $isExist = false;
                        $customerRecord = new Customer();
                        $userRecord = new User();
                        $userId = $userRecord->getId();
                    }                    
                }
                if($isExist){   
                    $this->setParametersForCustomer($customer, $customerRecord, $entityManager, 2, $userRecord, $userId);
                    $this->sendEmail($mailer, $customer);
                }
                else{
                    $this->setParametersForCustomer($customer, $customerRecord, $entityManager, 1, $userRecord,$userId);
                    $this->sendEmail($mailer, $customer);
                }

            }
        }
                
    }

    /**
     * @param $value
     * @param $customerRecord
     * @param $entityManager
     * @param $ifUpdateOrInsert
     * @param $userRecord
     * @param $userId
     * @throws \Exception
     */
    public function setParametersForCustomer(
        $value, 
        $customerRecord, 
        $entityManager,
        $ifUpdateOrInsert, 
        $userRecord,
        $userId
    ): void
    {
        $customerRecord->setCustomerId(strval($value->id));
        $customerRecord->setAcceptsMarketing($value->accepts_marketing);
        $customerRecord->setUser($userRecord);
        $customerRecord->setCreatedAt(new DateTimeImmutable($value->created_at));
        $customerRecord->setUpdatedAt(new DateTimeImmutable($value->updated_at));
        $customerRecord->setOrdersCount($value->orders_count);
        $customerRecord->setState($value->state);
        $customerRecord->setTotalSpent($value->total_spent);
        $customerRecord->setLastOrderId(strval($value->last_order_id));
        $customerRecord->setNote($value->note);
        $customerRecord->setVerifiedEmail($value->verified_email);
        $customerRecord->setMiltipassIdentifier($value->multipass_identifier);
        $customerRecord->setTaxExampt($value->tax_exempt);
        $customerRecord->setPhone($value->phone);
        $customerRecord->setTags($value->tags);
        $customerRecord->setLastOrderName($value->last_order_name);
        $customerRecord->setCurrency($value->currency);
        $customerRecord->setAddresses($value->addresses);
        $customerRecord->setAcceptsMarketingUpdatedAt(new DateTimeImmutable($value->accepts_marketing_updated_at));
        $customerRecord->setMarketingOptInLevel($value->marketing_opt_in_level);
        $customerRecord->setTaxExemptions($value->tax_exemptions);
        $customerRecord->setAdminGraphqlApiId($value->admin_graphql_api_id);

        $userRecord->setEmail($value->email);
        $userRecord->setRoles(['ROLE_CUSTOMER']);
        $userRecord->setPassword($this->passwordEncoder->encodePassword(
            $userRecord,
            'the_new_password'
        ));
        $userRecord->setFirstName($value->first_name);
        $userRecord->setLastName($value->last_name);
        if($ifUpdateOrInsert == 1){
            $customerRecord->setInsertByCustomerAt(new DateTimeImmutable());
        } 
        else if($ifUpdateOrInsert == 2){
            $customerRecord->setUpdateByCustomerAt(new DateTimeImmutable()); 
        } 
        $entityManager->persist($customerRecord);
        $entityManager->persist($userRecord);
        $entityManager->flush();
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return 'Import customer data';
    }

    /**
     * @param $mailer
     * @param $value
     */
    public function sendEmail($mailer, $value)
    {
        $message = (new \Swift_Message('Hello Email'))
        ->setFrom('send@example.com')
        ->setTo($value->email)
        ->setBody(
            '<p>Your importing data was updated successfuly!</p>'
            );
        $mailer->send($message);
    }
}


    