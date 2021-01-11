<?php

declare(strict_types=1);

namespace App\Commands;

use App\Entity\CustomerAddress;
use App\Repository\CustomerAddressRepository;
use DateTimeImmutable;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use function count;
use function in_array;
use function array_push;
use function strval;

/**
 * Class ImportCustomerAddressData
 * @package App\Commands
 */
final class ImportCustomerAddressData implements Command
{
    /**@var CustomerAddressRepository */
    private $customerAddressRepository;

    /**@var EntityManagerInterface */
    private $entityManager;

    /**
     * ImportCustomerAddressData constructor.
     * @param CustomerAddressRepository $customerAddressRepository
     * @param EntityManagerInterface $entityManager
     */
    public function __construct(CustomerAddressRepository $customerAddressRepository, EntityManagerInterface $entityManager)
    {
        $this->customerAddressRepository = $customerAddressRepository;
        $this->entityManager = $entityManager;
    }

    /**
     *
     */
    public function up(): void
    {
        $this->importCustomerAddressData($this->entityManager);
    }

    /**
     * @param $entityManager
     */
    private function importCustomerAddressData($entityManager): void
    {
        $url = 'https://ecd027e7165870006ff21f58e278c3fc:d11a55a65c712f779df5f28f551a4a89@thirty-six-purchase-it.myshopify.com/admin/api/2020-01/customers.json';
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $result = json_decode(curl_exec($ch));
        curl_close($ch);
        $independentCustomerAddressIds = [];
        foreach($result->customers as $customer){
            if (in_array($customer->id, $independentCustomerAddressIds)){
                continue;
            }
            else{
                array_push($independentCustomerAddressIds, $customer->id);
            }      
        }
        foreach($independentCustomerAddressIds as $customerAddressItem){
            $url1 = 'https://ecd027e7165870006ff21f58e278c3fc:d11a55a65c712f779df5f28f551a4a89@thirty-six-purchase-it.myshopify.com/admin/api/2020-01/customers/'.$customerAddressItem.'/addresses.json';
            $ch1 = curl_init($url1);
            curl_setopt($ch1, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
            curl_setopt($ch1, CURLOPT_RETURNTRANSFER, true);
            $result1 = json_decode(curl_exec($ch1));
            curl_close($ch1);
            foreach($result1->addresses as $individualAddress){
                $existingCustomerAddresses = $this->customerAddressRepository->findAll();
                if(count($existingCustomerAddresses) == 0){
                    $customerAddressRecord = new CustomerAddress();
                    $this->setParametersForCustomerAddress($individualAddress, $customerAddressRecord, $entityManager, 1);
                }
                else{
                    $isExist = false;
                    foreach($existingCustomerAddresses as $existingCustomerAddress){
                        if($existingCustomerAddress->getAddressId() == $individualAddress->id){
                            $isExist = true; 
                            $id = $existingCustomerAddress->getId();
                            $customerAddressRecord = $this->customerAddressRepository->find($id);
                            break;
                        }
                        else{
                            $isExist = false;
                        }                    
                    }
                    if($isExist){   
                        $this->setParametersForCustomerAddress($individualAddress, $customerAddressRecord, $entityManager, 2);
                    }
                    else{
                        $customerAddressRecord = new CustomerAddress();
                        $this->setParametersForCustomerAddress($individualAddress, $customerAddressRecord, $entityManager, 1);
                    }

                }
            }
            
        }
            
    }

    /**
     * @param $value
     * @param $customerAddressRecord
     * @param $entityManager
     * @param $ifUpdateOrInsert
     * @throws \Exception
     */
    public function setParametersForCustomerAddress($value, $customerAddressRecord, $entityManager, $ifUpdateOrInsert): void
    {
        $customerAddressRecord->setAddressId(strval($value->id));
        $customerAddressRecord->setCustomerId(strval($value->customer_id));
        $customerAddressRecord->setFirstName($value->first_name);
        $customerAddressRecord->setLastName($value->last_name);
        $customerAddressRecord->setCompany($value->company);
        $customerAddressRecord->setAddress1($value->address1);
        $customerAddressRecord->setAddress2($value->address2);
        $customerAddressRecord->setCity($value->city);
        $customerAddressRecord->setProvince($value->province);
        $customerAddressRecord->setCountry($value->country);
        $customerAddressRecord->setZip($value->zip);
        $customerAddressRecord->setPhone($value->phone);
        $customerAddressRecord->setName($value->name);
        $customerAddressRecord->setProvinceCode($value->province_code);
        $customerAddressRecord->setCountryCode($value->country_code);
        $customerAddressRecord->setCountryName($value->country_name);
        $customerAddressRecord->setAddressDefault($value->default);
        if($ifUpdateOrInsert == 1){
            $customerAddressRecord->setInsertByCustomerAt(new DateTimeImmutable());
        } 
        else if($ifUpdateOrInsert == 2){
            $customerAddressRecord->setUpdateByCustomerAt(new DateTimeImmutable()); 
        } 
        $entityManager->persist($customerAddressRecord);
        $entityManager->flush();
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return 'Import customerAddress data';
    }
}
