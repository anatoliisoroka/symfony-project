<?php

declare(strict_types=1);

namespace App\Commands;

use App\Entity\Themes;
use App\Repository\ThemesRepository;
use DateTimeImmutable;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use function count;
use function in_array;
use function array_push;
use function strval;

/**
 * Class ImportThemeData
 * @package App\Commands
 */
final class ImportThemeData implements Command
{
    /**@var ThemesRepository */
    private $themesRepository;

    /**@var EntityManagerInterface */
    private $entityManager;

    /**
     * ImportThemeData constructor.
     * @param ThemesRepository $themesRepository
     * @param EntityManagerInterface $entityManager
     */
    public function __construct(ThemesRepository $themesRepository, EntityManagerInterface $entityManager)
    {
        $this->themesRepository = $themesRepository;
        $this->entityManager = $entityManager;
    }

    /**
     *
     */
    public function up(): void
    {
        $this->importThemeData($this->entityManager);
    }

    /**
     * @param $entityManager
     */
    private function importThemeData($entityManager): void
    {
        $url = 'https://ecd027e7165870006ff21f58e278c3fc:d11a55a65c712f779df5f28f551a4a89@thirty-six-purchase-it.myshopify.com/admin/api/2020-01/themes.json';
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $result = json_decode(curl_exec($ch));
        curl_close($ch);
        foreach($result->themes as $theme){
            $existingThemes = $this->themesRepository->findAll();
            if(count($existingThemes) == 0){
                $themeRecord = new Themes();
                $this->setParametersForTheme($theme, $themeRecord, $entityManager, 1);
            }
            else{
                $isExist = false;
                foreach($existingThemes as $existingTheme){
                    if($existingTheme->getThemeId() == $theme->id){
                        $isExist = true; 
                        $id = $existingTheme->getId();
                        $themeRecord = $this->themesRepository->find($id);
                        break;
                    }
                    else{
                        $isExist = false;
                    }                    
                }
                if($isExist){   
                    $this->setParametersForTheme($theme, $themeRecord, $entityManager, 2);
                }
                else{
                    $themeRecord = new Themes();
                    $this->setParametersForTheme($theme, $themeRecord, $entityManager, 1);
                }

            }
        }
                
    }

    /**
     * @param $value
     * @param $themeRecord
     * @param $entityManager
     * @param $ifUpdateOrInsert
     * @throws \Exception
     */
    public function setParametersForTheme($value, $themeRecord, $entityManager, $ifUpdateOrInsert): void
    {
        $themeRecord->setThemeId(strval($value->id));
        $themeRecord->setName($value->name);
        $themeRecord->setCreatedAt(new DateTimeImmutable($value->created_at));
        $themeRecord->setUpdatedAt(new DateTimeImmutable($value->updated_at));
        $themeRecord->setRole($value->role);
        $themeRecord->setThemeStoreId($value->theme_store_id);
        $themeRecord->setPreviewable($value->previewable);
        $themeRecord->setProcessing($value->processing);
        $themeRecord->setAdminGraphqlApiId($value->admin_graphql_api_id);
        if($ifUpdateOrInsert == 1){
            $themeRecord->setInsertByCustomerAt(new DateTimeImmutable());
        } 
        else if($ifUpdateOrInsert == 2){
            $themeRecord->setUpdateByCustomerAt(new DateTimeImmutable()); 
        } 
        $entityManager->persist($themeRecord);
        $entityManager->flush();
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return 'Import theme data';
    }
}