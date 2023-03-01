<?php

namespace App\Controller;

use App\Entity\Student;
use App\Repository\StudentRepository;
use Doctrine\ORM\EntityManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class ApiStudentController extends AbstractController
{
    /**
     * @Route(
     * "/api/student", 
     * name="app_api_student",
     * methods={"GET"}
     * )
     */
    public function index(StudentRepository $studentRepository): JsonResponse
    {
        // Récuperer tous les étudiants :
        $students = $studentRepository->findAll();

        dd($students);

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
    public function add(Request $request, EntityManager $entityManager): JsonResponse
    {
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
        //$student->setPicture($dataFromRequest['picture']);
        $student->setDateOfBirth($dataFromRequest['date_of_birth']);
        $student->setGrade($dataFromRequest['grade']);

        // Insertion en base de l'instance student


        return $this->json([
            'status' => 'Ajout OK',
        ]);
    }
}
