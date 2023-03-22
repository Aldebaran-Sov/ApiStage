<?php

namespace App\Controller;

use App\Entity\Internship;
use App\Entity\Student;
use App\Repository\CompanyRepository;
use App\Repository\InternshipRepository;
use App\Repository\StudentRepository;
use App\Service\ApiKeyService;
use DateTime;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Exception\CircularReferenceException;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;
use Symfony\Component\Serializer\SerializerInterface;

class ApiInternshipController extends AbstractController
{
    /**
     * @Route(
     * "/api/internship", 
     * name="app_api_internship",
     * methods={"GET"}
     * )
     */
    public function index(InternshipRepository $internshipRepository, NormalizerInterface $normalizer, SerializerInterface $serializer): JsonResponse
    {
        $internships = $internshipRepository->findAll();

        //https://stackoverflow.com/questions/44286530/symfony-3-2-a-circular-reference-has-been-detected-configured-limit-1
        $json = $serializer->serialize($internships, 'json', [
            'circular_reference_handler' => function ($object) {
                return $object->getId();
            }
        ]);

        $internshipsNormalised = $normalizer -> normalize($internships, 'json', [
            'circular_reference_handler' => function ($object) {
                return $object->getId();
            }
        ]);

        dd($internships, $json, $internshipsNormalised);

        return $this->json([
            'message' => 'Welcome to your new controller!',
            'path' => 'src/Controller/ApiInternshipController.php',
        ]);
    }

    /**
     * @Route(
     * "/api/internship", 
     * name="app_api_internship_add",
     * methods={"POST"}
     * )
     */
    public function add(StudentRepository $studentRepository, CompanyRepository $companyRepository,Request $request, EntityManagerInterface $entityManager, ApiKeyService $apiKeyService)
    {
        if($apiKeyService->checkApiKey($request)){
            $dataFromRequest = $request->toArray();

            $dataFromRequest = $request->toArray();

            $internships = new Internship();
            $student = $studentRepository->find($dataFromRequest['id_student']);
            $company = $companyRepository->find($dataFromRequest["id_company"]);

            $internships->setIdStudent($student);
            $internships->setIdCompany($company);
            $internships->setStartDate(new DateTime($dataFromRequest['start_date']));
            $internships->setEndDate(new DateTime($dataFromRequest['end_date']));

            $entityManager -> persist($internships);
            $entityManager ->flush();

            return $this->json([
                'status' => 'Ajout OK',
            ]);
        }else{
            return $this->json([
                'status' => 'Cles API invalide',
            ]);
        }



        

    }
}