<?php

namespace App\Controller;

use App\Entity\Company;
use App\Repository\CompanyRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

class ApiCompanyController extends AbstractController
{
    /**
     * @Route(
     * "/api/company",
     * name="app_api_company",
     * methods={"GET"}
     * )
     */
    public function index(CompanyRepository $companyRepository, NormalizerInterface $normalizer): JsonResponse
    {
        $companys = $companyRepository->findAll();
        $json = json_encode($companys);
        $companysNormalised = $normalizer -> normalize($companys, 'json', [
            'circular_reference_handler' => function ($object) {
                return $object->getId();
            }
        ]);
        dd($companys, $json, $companysNormalised);
        return $this->json([
            'message' => 'Welcome to your new controller!',
            'path' => 'src/Controller/ApiCompanyController.php',
        ]);
    }

    /**
     * @Route(
     * "/api/company",
     * name="app_api_company_add",
     * methods={"POST"}
     * )
     */
    public function add(Request $request, EntityManagerInterface $entityManager): JsonResponse
    {
        $dataFromRequest = $request->toArray();

        $company = new Company();
        $company->setName($dataFromRequest['name']);
        $company->setStreet($dataFromRequest['street']);
        $company->setZipcode($dataFromRequest['zipcode']);
        $company->setCity($dataFromRequest['city']);
        $company->setWebsite($dataFromRequest['website']);

        $entityManager -> persist($company);
        $entityManager ->flush();

        return $this->json([
            'status' => 'Ajout OK',
        ]);
    }
}
