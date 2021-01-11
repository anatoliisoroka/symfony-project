<?php

declare(strict_types=1);

namespace App\Commands;

use App\Entity\Products;
use App\Repository\ProductsRepository;
use DateTimeImmutable;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use function count;
use function in_array;
use function array_push;
use function strval;

/**
 * Class ImportProductData
 * @package App\Commands
 */
final class ImportProductData implements Command
{
    /**@var ProductsRepository */
    private $productsRepository;

    /**@var EntityManagerInterface */
    private $entityManager;

    /**
     * ImportProductData constructor.
     * @param ProductsRepository $productsRepository
     * @param EntityManagerInterface $entityManager
     */
    public function __construct(ProductsRepository $productsRepository, EntityManagerInterface $entityManager)
    {
        $this->productsRepository = $productsRepository;
        $this->entityManager = $entityManager;
    }

    /**
     *
     */
    public function up(): void
    {
        $this->importProductData($this->entityManager);
    }

    /**
     * @param $entityManager
     */
    private function importProductData($entityManager): void
    {
        $url = 'https://ecd027e7165870006ff21f58e278c3fc:d11a55a65c712f779df5f28f551a4a89@thirty-six-purchase-it.myshopify.com/admin/api/2020-01/products.json';
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $result = json_decode(curl_exec($ch));
        curl_close($ch);
        
        foreach($result->products as $product){
            //return new JsonResponse($product->id);

            $existingProducts = $this->productsRepository->findAll();
            if(count($existingProducts) == 0){
                $productRecord = new Products();
                $this->setParametersForProduct($product, $productRecord, $entityManager, 1);
            }
            else{
                $isExist = false;
                foreach($existingProducts as $existingProduct){
                    if($existingProduct->getProductionId() == $product->id){
                        $isExist = true; 
                        $id = $existingProduct->getId();
                        $productRecord = $this->productsRepository->find($id);
                        break;
                    }
                    else{
                        $isExist = false;
                    }                    
                }
                if($isExist){   
                    $this->setParametersForProduct($product, $productRecord, $entityManager, 2);
                }
                else{
                    $productRecord = new Products();
                    $this->setParametersForProduct($product, $productRecord, $entityManager, 1);
                }

            }
        }
        
    }

    /**
     * @param $value
     * @param $productRecord
     * @param $entityManager
     * @param $ifUpdateOrInsert
     * @throws \Exception
     */
    public function setParametersForProduct($value, $productRecord, $entityManager, $ifUpdateOrInsert): void
    {
        $productRecord->setProductionId(strval($value->id));
        $productRecord->setTitle($value->title);
        $productRecord->setVendor($value->vendor);
        $productRecord->setProductType($value->product_type);
        $productRecord->setProductCreatedAt(new DateTimeImmutable($value->created_at));
        $productRecord->setHandle($value->handle);
        $productRecord->setProductUpdatedAt(new DateTimeImmutable($value->updated_at));
        $productRecord->setProductPublishedAt(null);
        $productRecord->setPublishedScope($value->published_scope);
        $productRecord->setTags($value->tags);
        $productRecord->setAdminGraphqlApiId($value->admin_graphql_api_id);
        $productRecord->setVariantsId(strval($value->variants[0]->id));
        $productRecord->setOptionsId(strval($value->options[0]->id));
        $productRecord->setOptionsName($value->options[0]->name);
        $productRecord->setPosition($value->options[0]->position);
        $productRecord->setOptionsValues($value->options[0]->values[0]);
        $productRecord->setImages(null);
        if($ifUpdateOrInsert == 1){
            $productRecord->setInsertByCustomerAt(new DateTimeImmutable());
        } 
        else if($ifUpdateOrInsert == 2){
            $productRecord->setUpdateByCustomerAt(new DateTimeImmutable()); 
        } 
        $entityManager->persist($productRecord);
        $entityManager->flush();
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return 'Import product data';
    }
}