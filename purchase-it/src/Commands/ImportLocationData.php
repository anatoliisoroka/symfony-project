<?php

declare(strict_types=1);

namespace App\Commands;

use App\Entity\Locations;
use App\Repository\LocationsRepository;
use DateTimeImmutable;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use function count;
use function in_array;
use function array_push;
use function strval;

/**
 * Class ImportLocationData
 * @package App\Commands
 */
final class ImportLocationData implements Command
{
    /**@var LocationsRepository */
    private $locationsRepository;

    /**@var EntityManagerInterface */
    private $entityManager;

    /**
     * ImportLocationData constructor.
     * @param LocationsRepository $locationsRepository
     * @param EntityManagerInterface $entityManager
     */
    public function __construct(LocationsRepository $locationsRepository, EntityManagerInterface $entityManager)
    {
        $this->locationsRepository = $locationsRepository;
        $this->entityManager = $entityManager;
    }

    /**
     *
     */
    public function up(): void
    {
        $this->importLocationData($this->entityManager);
    }

    /**
     * @param $entityManager
     */
    private function importLocationData($entityManager): void
    {
        $url = 'https://ecd027e7165870006ff21f58e278c3fc:d11a55a65c712f779df5f28f551a4a89@thirty-six-purchase-it.myshopify.com/admin/api/2020-01/locations.json';
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $result = json_decode(curl_exec($ch));
        curl_close($ch);
        foreach($result->locations as $location){
            $existingLocations = $this->locationsRepository->findAll();
            if(count($existingLocations) == 0){
                $locationRecord = new Locations();
                $this->setParametersForLocation($location, $locationRecord, $entityManager, 1);
            }
            else{
                $isExist = false;
                foreach($existingLocations as $existingLocation){
                    if($existingLocation->getLocationId() == $location->id){
                        $isExist = true; 
                        $id = $existingLocation->getId();
                        $locationRecord = $this->locationsRepository->find($id);
                        break;
                    }
                    else{
                        $isExist = false;
                    }                    
                }
                if($isExist){   
                    $this->setParametersForLocation($location, $locationRecord, $entityManager, 2);
                }
                else{
                    $locationRecord = new Locations();
                    $this->setParametersForLocation($location, $locationRecord, $entityManager, 1);
                }

            }
        }
                
    }

    /**
     * @param $value
     * @param $locationRecord
     * @param $entityManager
     * @param $ifUpdateOrInsert
     * @throws \Exception
     */
    public function setParametersForLocation($value, $locationRecord, $entityManager, $ifUpdateOrInsert): void
    {
        $locationRecord->setLocationId(strval($value->id));
        $locationRecord->setName($value->name);
        $locationRecord->setAddress1($value->address1);
        $locationRecord->setAddress2($value->address2);
        $locationRecord->setCity($value->city);
        $locationRecord->setProvince($value->province);
        $locationRecord->setZip($value->zip);
        $locationRecord->setCountry($value->country);
        $locationRecord->setPhone($value->phone);
        $locationRecord->setCreatedAt(new DateTimeImmutable($value->created_at));
        $locationRecord->setUpdatedAt(new DateTimeImmutable($value->updated_at));
        $locationRecord->setCountryCode($value->country_code);
        $locationRecord->setCountryName($value->country_name);
        $locationRecord->setProvinceCode($value->province_code);
        $locationRecord->setLegacy($value->legacy);
        $locationRecord->setActive($value->active);
        $locationRecord->setAdminGraphqlApiId($value->admin_graphql_api_id);
        if($ifUpdateOrInsert == 1){
            $locationRecord->setInsertByCustomerAt(new DateTimeImmutable());
        } 
        else if($ifUpdateOrInsert == 2){
            $locationRecord->setUpdateByCustomerAt(new DateTimeImmutable()); 
        } 
        $entityManager->persist($locationRecord);
        $entityManager->flush();
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return 'Import location data';
    }
}