<?php

declare(strict_types=1);

namespace App\Commands;

use App\Entity\Policies;
use App\Repository\PoliciesRepository;
use DateTimeImmutable;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use function count;
use function in_array;
use function array_push;
use function strval;
use function explode;

/**
 * Class ImportPolicyData
 * @package App\Commands
 */
final class ImportPolicyData implements Command
{
    /**@var PoliciesRepository */
    private $policiesRepository;

    /**@var EntityManagerInterface */
    private $entityManager;

    /**
     * ImportPolicyData constructor.
     * @param PoliciesRepository $policiesRepository
     * @param EntityManagerInterface $entityManager
     */
    public function __construct(PoliciesRepository $policiesRepository, EntityManagerInterface $entityManager)
    {
        $this->policiesRepository = $policiesRepository;
        $this->entityManager = $entityManager;
    }

    /**
     *
     */
    public function up(): void
    {
        $this->importPolicyData($this->entityManager);
    }

    /**
     * @param $entityManager
     */
    private function importPolicyData($entityManager): void
    {
        $url = 'https://ecd027e7165870006ff21f58e278c3fc:d11a55a65c712f779df5f28f551a4a89@thirty-six-purchase-it.myshopify.com/admin/api/2020-01/policies.json';
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $result = json_decode(curl_exec($ch));
        curl_close($ch);
        foreach($result->policies as $policy){
            $existingPolicies = $this->policiesRepository->findAll();
            if(count($existingPolicies) == 0){
                $policyRecord = new Policies();
                $this->setParametersForPolicy($policy, $policyRecord, $entityManager, 1);
            }
            else{
                $isExist = false;
                foreach($existingPolicies as $existingPolicy){
                    if(explode("/", $existingPolicy->getUrl())[5] == explode("/", $policy->url)[5]){
                        $isExist = true; 
                        $id = $existingPolicy->getId();
                        $policyRecord = $this->policiesRepository->find($id);
                        break;
                    }
                    else{
                        $isExist = false;
                    }                    
                }
                if($isExist){   
                    $this->setParametersForPolicy($policy, $policyRecord, $entityManager, 2);
                }
                else{
                    $policyRecord = new Policies();
                    $this->setParametersForPolicy($policy, $policyRecord, $entityManager, 1);
                }

            }
        }
                
    }

    /**
     * @param $value
     * @param $policyRecord
     * @param $entityManager
     * @param $ifUpdateOrInsert
     * @throws \Exception
     */
    public function setParametersForPolicy($value, $policyRecord, $entityManager, $ifUpdateOrInsert): void
    {
        $policyRecord->setBody($value->body);
        $policyRecord->setCreatedAt(new DateTimeImmutable($value->created_at));
        $policyRecord->setUpdateAt(new DateTimeImmutable($value->updated_at));
        $policyRecord->setHandle($value->handle);
        $policyRecord->setTitle($value->title);
        $policyRecord->setUrl($value->url);
        if($ifUpdateOrInsert == 1){
            $policyRecord->setInsertByCustomerAt(new DateTimeImmutable());
        } 
        else if($ifUpdateOrInsert == 2){
            $policyRecord->setUpdateByCustomerAt(new DateTimeImmutable()); 
        } 
        $entityManager->persist($policyRecord);
        $entityManager->flush();
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return 'Import policy data';
    }
}