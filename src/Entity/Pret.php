<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\PretRepository;
use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass=PretRepository::class)
 * @ApiResource(
 *  normalizationContext={
 *      "groups"={"prets_read"}
 *  },
 *  attributes={
 *      "order":{"id":"desc"}      
 *  }
 * )
 */
class Pret
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups({"prets_read", "books_read", "lecteurs_read"})
     */
    private $id;
    
    /**
     * @ORM\ManyToOne(targetEntity=Lecteur::class, inversedBy="prets")
     * @ORM\JoinColumn(nullable=false)
     * @Groups({"prets_read", "books_read"})
     */
    private $lecteur;
    
    /**
     * @ORM\ManyToOne(targetEntity=Livre::class, inversedBy="pret")
     * @ORM\JoinColumn(nullable=false)
     * @Groups({"prets_read", "lecteurs_read"})
     */
    private $livre;
    
    /**
     * @ORM\Column(type="datetime")
     * @Groups({"prets_read"})
     */
    private $datePret;
    
    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"prets_read", "lecteurs_read", "books_read"})
     */
    private $rendu;

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

    public function getRendu(): ?string
    {
        return $this->rendu;
    }

    public function setRendu(string $rendu): self
    {
        $this->rendu = $rendu;

        return $this;
    }
}
