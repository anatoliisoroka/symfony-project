<?php

declare(strict_types=1);

namespace App\Commands;

use App\Entity\Payouts;
use App\Repository\PayoutsRepository;
use DateTimeImmutable;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use function count;
use function in_array;
use function array_push;
use function strval;

/**
 * Class ImportPayoutData
 * @package App\Commands
 */
final class ImportPayoutData implements Command
{
    /**@var PayoutsRepository */
    private $payoutsRepository;

    /**@var EntityManagerInterface */
    private $entityManager;

    /**
     * ImportPayoutData constructor.
     * @param PayoutsRepository $payoutsRepository
     * @param EntityManagerInterface $entityManager
     */
    public function __construct(PayoutsRepository $payoutsRepository, EntityManagerInterface $entityManager)
    {
        $this->payoutsRepository = $payoutsRepository;
        $this->entityManager = $entityManager;
    }

    /**
     *
     */
    public function up(): void
    {
        $this->importPayoutData($this->entityManager);
    }

    /**
     * @param $entityManager
     */
    private function importPayoutData($entityManager): void
    {
        $url = 'https://ecd027e7165870006ff21f58e278c3fc:d11a55a65c712f779df5f28f551a4a89@thirty-six-purchase-it.myshopify.com/admin/api/2020-01/shopify_payments/payouts.json';
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $result = json_decode(curl_exec($ch));
        curl_close($ch);
        foreach($result->payouts as $payout){
            $existingPayouts = $this->payoutsRepository->findAll();
            if(count($existingPayouts) == 0){
                $payoutRecord = new Payouts();
                $this->setParametersForPayout($payout, $payoutRecord, $entityManager, 1);
            }
            else{
                $isExist = false;
                foreach($existingPayouts as $existingPayout){
                    if($existingPayout->getPayoutId() == $payout->id){
                        $isExist = true; 
                        $id = $existingPayout->getId();
                        $payoutRecord = $this->payoutsRepository->find($id);
                        break;
                    }
                    else{
                        $isExist = false;
                    }                    
                }
                if($isExist){   
                    $this->setParametersForPayout($payout, $payoutRecord, $entityManager, 2);
                }
                else{
                    $payoutRecord = new Payouts();
                    $this->setParametersForPayout($payout, $payoutRecord, $entityManager, 1);
                }

            }
        }
                
    }

    /**
     * @param $value
     * @param $payoutRecord
     * @param $entityManager
     * @param $ifUpdateOrInsert
     * @throws \Exception
     */
    public function setParametersForPayout($value, $payoutRecord, $entityManager, $ifUpdateOrInsert): void
    {
        $payoutRecord->setPayoutId(strval($value->id));
        $payoutRecord->setStatus($value->status);
        $payoutRecord->setDate(new DateTimeImmutable($value->date));
        $payoutRecord->setCurrency($value->currency);
        $payoutRecord->setAmount($value->amount);
        $payoutRecord->setSummary($value->summary);
        $entityManager->persist($payoutRecord);
        $entityManager->flush();
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return 'Import payout data';
    }
}