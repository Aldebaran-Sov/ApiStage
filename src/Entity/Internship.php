<?php

namespace App\Entity;

use App\Repository\InternshipRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=InternshipRepository::class)
 */
class Internship
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Student::class, inversedBy="internships")
     * @ORM\JoinColumn(nullable=false)
     */
    private $id_student;

    /**
     * @ORM\ManyToOne(targetEntity=Company::class, inversedBy="internships")
     * @ORM\JoinColumn(nullable=false)
     */
    private $id_company;

    /**
     * @ORM\Column(type="date")
     */
    private $start_date;

    /**
     * @ORM\Column(type="date")
     */
    private $end_date;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdStudent(): ?Student
    {
        return $this->id_student;
    }

    public function setIdStudent(?Student $id_student): self
    {
        $this->id_student = $id_student;

        return $this;
    }

    public function getIdCompany(): ?Company
    {
        return $this->id_company;
    }

    public function setIdCompany(?Company $id_company): self
    {
        $this->id_company = $id_company;

        return $this;
    }

    public function getStartDate(): ?\DateTimeInterface
    {
        return $this->start_date;
    }

    public function setStartDate(\DateTimeInterface $start_date): self
    {
        $this->start_date = $start_date;

        return $this;
    }

    public function getEndDate(): ?\DateTimeInterface
    {
        return $this->end_date;
    }

    public function setEndDate(\DateTimeInterface $end_date): self
    {
        $this->end_date = $end_date;

        return $this;
    }
}
