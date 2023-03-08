<?php

namespace App\Controller;

use App\Repository\CompanyRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\BrowserKit\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
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
        //$json = json_decode($companys);
        $companysNormalised = $normalizer -> normalize($companys);
        dd($companys);
        return $this->json([
            'message' => 'Welcome to your new controller!',
            'path' => 'src/Controller/ApiCompanyController.php',
        ]);
    }

    public function add(Request $request, EntityManagerInterface $entityManager): JsonResponse
    {
        return $this->json([
            'message' => 'Welcome to your new controller!',
            'path' => 'src/Controller/ApiCompanyController.php',
        ]);
    }
}
