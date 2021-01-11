<?php

declare(strict_types=1);

namespace App\Commands;

use App\Entity\GiftCard;
use App\Repository\GiftCardRepository;
use DateTimeImmutable;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use function count;
use function in_array;
use function array_push;
use function strval;

/**
 * Class ImportGiftCardData
 * @package App\Commands
 */
final class ImportGiftCardData implements Command
{
    /**@var GiftCardRepository */
    private $giftCardRepository;

    /**@var EntityManagerInterface */
    private $entityManager;

    /**
     * ImportGiftCardData constructor.
     * @param GiftCardRepository $giftCardRepository
     * @param EntityManagerInterface $entityManager
     */
    public function __construct(GiftCardRepository $giftCardRepository, EntityManagerInterface $entityManager)
    {
        $this->giftCardRepository = $giftCardRepository;
        $this->entityManager = $entityManager;
    }

    /**
     *
     */
    public function up(): void
    {
        $this->importGiftCardData($this->entityManager);
    }

    /**
     * @param $entityManager
     */
    private function importGiftCardData($entityManager): void
    {
        $url = 'https://ecd027e7165870006ff21f58e278c3fc:d11a55a65c712f779df5f28f551a4a89@thirty-six-purchase-it.myshopify.com/admin/api/2020-01/gift_cards.json';
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $result = json_decode(strval(curl_exec($ch)));
        curl_close($ch);
        foreach($result->gift_cards as $gift_card){
            $existingGiftCards = $this->giftCardRepository->findAll();
            if(count($existingGiftCards) == 0){
                $giftCardRecord = new GiftCard();
                $this->setParametersForGiftCard($gift_card, $giftCardRecord, $entityManager, 1);
            }
            else{
                $isExist = false;
                foreach($existingGiftCards as $existingGiftCard){
                    if($existingGiftCard->getGiftCardId() == $gift_card->id){
                        $isExist = true; 
                        $id = $existingGiftCard->getId();
                        $giftCardRecord = $this->giftCardRepository->find($id);
                        break;
                    }
                    else{
                        $isExist = false;
                    }                    
                }
                if($isExist){   
                    $this->setParametersForGiftCard($gift_card, $giftCardRecord, $entityManager, 2);
                }
                else{
                    $giftCardRecord = new GiftCard();
                    $this->setParametersForGiftCard($gift_card, $giftCardRecord, $entityManager, 1);
                }

            }
        }
                
    }

    /**
     * @param $value
     * @param $giftCardRecord
     * @param $entityManager
     * @param $ifUpdateOrInsert
     * @throws \Exception
     */
    public function setParametersForGiftCard($value, $giftCardRecord, $entityManager, $ifUpdateOrInsert): void
    {
        $giftCardRecord->setGiftCardId(strval($value->id));
        $giftCardRecord->setBalance($value->balance);
        $giftCardRecord->setCreatedAt(new DateTimeImmutable($value->created_at));
        $giftCardRecord->setUpdatedAt(new DateTimeImmutable($value->updated_at));
        $giftCardRecord->setCurrency($value->currency);
        $giftCardRecord->setInitialValue($value->initial_value);
        $giftCardRecord->setDisabledAt($value->disabled_at === null ? null: new DateTimeImmutable($value->disabled_at));
        $giftCardRecord->setLineItemId($value->line_item_id);
        $giftCardRecord->setApiClientId($value->api_client_id);

        $giftCardRecord->setUserId(strval($value->user_id));
        $giftCardRecord->setCustomerId(strval($value->customer_id));
        $giftCardRecord->setNote($value->note);
        $giftCardRecord->setExpiresOn($value->expires_on);
        $giftCardRecord->setTemplateSuffix($value->template_suffix);
        $giftCardRecord->setLastCharacters($value->last_characters);
        $giftCardRecord->setOrderId($value->order_id);
        if($ifUpdateOrInsert == 1){
            $giftCardRecord->setInsertByCustomerAt(new DateTimeImmutable());
        } 
        else if($ifUpdateOrInsert == 2){
            $giftCardRecord->setUpdateByCustomerAt(new DateTimeImmutable()); 
        } 
        $entityManager->persist($giftCardRecord);
        $entityManager->flush();
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return 'Import giftCards data';
    }
}