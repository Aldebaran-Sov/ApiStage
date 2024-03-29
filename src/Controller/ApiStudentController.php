<?php

namespace App\Controller;

use App\Entity\Student;
use App\Repository\StudentRepository;
use App\Service\ApiKeyService;
use DateTime;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;
use Symfony\Component\Serializer\SerializerInterface;

class ApiStudentController extends AbstractController
{
    /**
     * @Route(
     * "/api/student", 
     * name="app_api_student",
     * methods={"GET"}
     * )
     */
    public function index(/*injection de dépendences*/StudentRepository $studentRepository, NormalizerInterface $normalizer, SerializerInterface $serializer): JsonResponse
    {
        // Récuperer tous les étudiants :
        $students = $studentRepository->findAll();

        // Sérialisation au format JSON
        //$json = json_encode($students);
        $json = $serializer->serialize($students, 'json', [
            'circular_reference_handler' => function ($object) {
                return $object->getId();
            }
        ]);
        // Ne vas pas marcher car les attributs sont en private
        // Il faut normaliser
        $studentsNormalised = $normalizer -> normalize($students, 'json', [
            'circular_reference_handler' => function ($object) {
                return $object->getId();
            }
        ]);

        dd($students, $json, $studentsNormalised);

        return $this->json([
            'message' => 'Welcome to your new controller!',
            'path' => 'src/Controller/ApiStudentController.php',
        ]);
    }

    /**
     * @Route(
     * "/api/student", 
     * name="app_api_student_add",
     * methods={"POST"}
     * )
     */
    public function add(Request $request, EntityManagerInterface $entityManager, ApiKeyService $apiKeyService): JsonResponse
    {
        if($apiKeyService->checkApiKey($request)){
            // On attend une requête au format json (Content-Type application/json)
            // TODO: Vérifier le Content-Type

            // Récupération du body (les info) que l'on transforme depuis du JSON en tableau
            // dd($request -> toArray());

            // On stocke le body de la requête dans $dataFromRequest
            $dataFromRequest = $request->toArray();

            // *********************************
            // Ici, les données ont été vérifiées, on peut créer une nouvelle instance de Student
            $student = new Student();
            $student->setName($dataFromRequest['name']);
            $student->setFirstName($dataFromRequest['first_name']);
            $student->setPicture($dataFromRequest['picture']);
            $student->setDateOfBirth(new DateTime($dataFromRequest['date_of_birth']));
            $student->setGrade($dataFromRequest['grade']);
            //dd($student);
            // Insertion en base de l'instance student
            $entityManager -> persist($student);
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
