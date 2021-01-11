<?php

declare(strict_types=1);

namespace App\Commands;

use App\Entity\Collection;
use App\Repository\CollectionRepository;
use DateTimeImmutable;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use function count;
use function in_array;
use function array_push;
use function strval;

/**
 * Class ImportCollectionData
 * @package App\Commands
 */
final class ImportCollectionData implements Command
{
    /**@var CollectionRepository */
    private $collectionRepository;

    /**@var EntityManagerInterface */
    private $entityManager;

    /**
     * ImportCollectionData constructor.
     * @param CollectionRepository $collectionRepository
     * @param EntityManagerInterface $entityManager
     */
    public function __construct(CollectionRepository $collectionRepository, EntityManagerInterface $entityManager)
    {
        $this->collectionRepository = $collectionRepository;
        $this->entityManager = $entityManager;
    }

    /**
     *
     */
    public function up(): void
    {
        $this->importCollectionData($this->entityManager);
    }

    /**
     * @param $entityManager
     */
    private function importCollectionData($entityManager): void
    {
        $url = 'https://ecd027e7165870006ff21f58e278c3fc:d11a55a65c712f779df5f28f551a4a89@thirty-six-purchase-it.myshopify.com/admin/api/2020-01/collects.json';
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $result = json_decode(curl_exec($ch));
        curl_close($ch);
        $independentCollIds = [];
        foreach($result->collects as $collect){
            if (in_array($collect->collection_id, $independentCollIds)){
                continue;
            }
            else{
                array_push($independentCollIds,$collect->collection_id);
            }      
        }
        foreach($independentCollIds as $collItem){
            $url1 = 'https://ecd027e7165870006ff21f58e278c3fc:d11a55a65c712f779df5f28f551a4a89@thirty-six-purchase-it.myshopify.com/admin/api/2020-01/collections/'.$collItem.'.json';
            $ch1 = curl_init($url1);
            curl_setopt($ch1, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
            curl_setopt($ch1, CURLOPT_RETURNTRANSFER, true);
            $result1 = json_decode(curl_exec($ch1));
            curl_close($ch1);
            $existingCollections = $this->collectionRepository->findAll();
            if(count($existingCollections) == 0){
                $collection = new Collection();
                $this->setParametersForCollection($result1, $collection, $entityManager, 1);
            }
            else{
                $isExist = false;
                foreach($existingCollections as $existingConllection){
                    if($existingConllection->getCollectionId() == $result1->collection->id){
                        $isExist = true; 
                        $id = $existingConllection->getId();
                        $collection = $this->collectionRepository->find($id);
                        break;
                    }
                    else{
                        $isExist = false;
                    }                    
                }
                if($isExist){   
                    $this->setParametersForCollection($result1, $collection, $entityManager, 2);
                }
                else{
                    $collection = new Collection();
                    $this->setParametersForCollection($result1, $collection, $entityManager, 1);
                }

            }
        }
            
    }

    /**
     * @param $value
     * @param $collection
     * @param $entityManager
     * @param $ifUpdateOrInsert
     * @throws \Exception
     */
    public function setParametersForCollection($value, $collection, $entityManager, $ifUpdateOrInsert): void
    {
        $collection->setCollectionId(strval($value->collection->id));
        $collection->setHandle($value->collection->handle);
        $collection->setTitle($value->collection->title);
        $collection->setUpdatedAt(new DateTimeImmutable($value->collection->updated_at));
        $collection->setProductUpdatedDate($value->collection->updated_at);
        $collection->setBodyHtml($value->collection->body_html);
        $collection->setPublishedAt(new DateTimeImmutable($value->collection->published_at));
        $collection->setSortOrder($value->collection->sort_order);
        $collection->setProductsCount($value->collection->products_count);
        $collection->setCollectionType($value->collection->collection_type);
        $collection->setPublishedScope($value->collection->published_scope);
        if($ifUpdateOrInsert == 1){
            $collection->setInsertAt(new DateTimeImmutable());
        } 
        else if($ifUpdateOrInsert == 2){
            $collection->setUpdatedBycustomerAt(new DateTimeImmutable()); 
        } 
        $entityManager->persist($collection);
        $entityManager->flush();
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return 'Import collection data';
    }
}
