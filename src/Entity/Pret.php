<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\PretRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass=PretRepository::class)
 */
class Pret
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Lecteur::class, inversedBy="prets")
     * @ORM\JoinColumn(nullable=false)
     */
    private $lecteur;

    /**
     * @ORM\OneToOne(targetEntity=Livre::class, inversedBy="pret", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $livre;

    /**
     * @ORM\Column(type="datetime")
     */
    private $datePret;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLecteur(): ?Lecteur
    {
        return $this->lecteur;
    }

    public function setLecteur(?Lecteur $lecteur): self
    {
        $this->lecteur = $lecteur;

        return $this;
    }

    public function getLivre(): ?Livre
    {
        return $this->livre;
    }

    public function setLivre(Livre $livre): self
    {
        $this->livre = $livre;

        return $this;
    }

    public function getDatePret(): ?\DateTimeInterface
    {
        return $this->datePret;
    }

    public function setDatePret(\DateTimeInterface $datePret): self
    {
        $this->datePret = $datePret;

        return $this;
    }
}
