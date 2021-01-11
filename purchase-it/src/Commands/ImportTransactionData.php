<?php

declare(strict_types=1);

namespace App\Commands;

use App\Entity\Transactions;
use App\Repository\TransactionsRepository;
use DateTimeImmutable;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use function count;
use function in_array;
use function array_push;
use function strval;

/**
 * Class ImportTransactionData
 * @package App\Commands
 */
final class ImportTransactionData implements Command
{
    /**@var TransactionsRepository */
    private $transactionsRepository;

    /**@var EntityManagerInterface */
    private $entityManager;

    /**
     * ImportTransactionData constructor.
     * @param TransactionsRepository $transactionsRepository
     * @param EntityManagerInterface $entityManager
     */
    public function __construct(TransactionsRepository $transactionsRepository, EntityManagerInterface $entityManager)
    {
        $this->transactionsRepository = $transactionsRepository;
        $this->entityManager = $entityManager;
    }

    /**
     *
     */
    public function up(): void
    {
        $this->importTransactionData($this->entityManager);
    }

    /**
     * @param $entityManager
     */
    private function importTransactionData($entityManager): void
    {
        $url = 'https://ecd027e7165870006ff21f58e278c3fc:d11a55a65c712f779df5f28f551a4a89@thirty-six-purchase-it.myshopify.com/admin/api/2020-01/shopify_payments/balance/transactions.json';
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $result = json_decode(curl_exec($ch));
        curl_close($ch);
        foreach($result->transactions as $transaction){
            $existingTransactions = $this->transactionsRepository->findAll();
            if(count($existingTransactions) == 0){
                $transactionRecord = new Transactions();
                $this->setParametersForTransaction($transaction, $transactionRecord, $entityManager, 1);
            }
            else{
                $isExist = false;
                foreach($existingTransactions as $existingTransaction){
                    if($existingTransaction->getTransactionId() == $transaction->id){
                        $isExist = true; 
                        $id = $existingTransaction->getId();
                        $transactionRecord = $this->transactionsRepository->find($id);
                        break;
                    }
                    else{
                        $isExist = false;
                    }                    
                }
                if($isExist){   
                    $this->setParametersForTransaction($transaction, $transactionRecord, $entityManager, 2);
                }
                else{
                    $transactionRecord = new Transactions();
                    $this->setParametersForTransaction($transaction, $transactionRecord, $entityManager, 1);
                }

            }
        }
                
    }

    /**
     * @param $value
     * @param $transactionRecord
     * @param $entityManager
     * @param $ifUpdateOrInsert
     * @throws \Exception
     */
    public function setParametersForTransaction($value, $transactionRecord, $entityManager, $ifUpdateOrInsert): void
    {
        $transactionRecord->setTransactionId(strval($value->id));
        $transactionRecord->setType($value->type);
        $transactionRecord->setPayoutId(strval($value->payout_id));
        $transactionRecord->setPayoutStatus($value->payout_status);
        $transactionRecord->setCurrency($value->currency);
        $transactionRecord->setAmount($value->amount);

        $transactionRecord->setFee($value->fee);
        $transactionRecord->setNet($value->net);
        $transactionRecord->setSourceId(strval($value->source_id));
        $transactionRecord->setSourceType($value->source_type);
        $transactionRecord->setSourceOrderId(strval($value->source_order_id));
        $transactionRecord->setSourceOrderTransactionId(strval($value->source_order_transaction_id));
        $transactionRecord->setProcessedAt(new DateTimeImmutable($value->processed_at));
        if($ifUpdateOrInsert == 1){
            $transactionRecord->setInsertByCustomerAt(new DateTimeImmutable());
        } 
        else if($ifUpdateOrInsert == 2){
            $transactionRecord->setUpdateByCustomerAt(new DateTimeImmutable()); 
        } 
        $entityManager->persist($transactionRecord);
        $entityManager->flush();
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return 'Import transaction data';
    }
}