<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\LecteurRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=LecteurRepository::class)
 * @ApiResource()
 */
class Lecteur
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nomLecteur;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $prenomLecteur;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomLecteur(): ?string
    {
        return $this->nomLecteur;
    }

    public function setNomLecteur(string $nomLecteur): self
    {
        $this->nomLecteur = $nomLecteur;

        return $this;
    }

    public function getPrenomLecteur(): ?string
    {
        return $this->prenomLecteur;
    }

    public function setPrenomLecteur(string $prenomLecteur): self
    {
        $this->prenomLecteur = $prenomLecteur;

        return $this;
    }
}
