<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\LivreRepository;
use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass=LivreRepository::class)
 * @ApiResource(
 *  normalizationContext={
 *      "groups"={"books_read"}  
 *  },
 *  attributes={
 *      "order":{"id":"desc"}      
 *  }
 * )
 */
class Livre
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups({"books_read", "prets_read", "lecteurs_read"})
     */
    private $id;
    
    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"books_read", "prets_read", "lecteurs_read"})
     */
    private $design;
    
    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"books_read", "prets_read", "lecteurs_read"})
     */
    private $auteur;
    
    /**
     * @ORM\Column(type="datetime")
     * @Groups({"books_read"})
     */
    private $dateEdition;
    
    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"books_read"})
     */
    private $disponible;
    
    /**
     * @ORM\OneToOne(targetEntity=Pret::class, mappedBy="livre", cascade={"persist", "remove"})
     * @Groups({"books_read"})
     */
    private $pret;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDesign(): ?string
    {
        return $this->design;
    }

    public function setDesign(string $design): self
    {
        $this->design = $design;

        return $this;
    }

    public function getAuteur(): ?string
    {
        return $this->auteur;
    }

    public function setAuteur(string $auteur): self
    {
        $this->auteur = $auteur;

        return $this;
    }

    public function getDateEdition(): ?\DateTimeInterface
    {
        return $this->dateEdition;
    }

    public function setDateEdition(\DateTimeInterface $dateEdition): self
    {
        $this->dateEdition = $dateEdition;

        return $this;
    }

    public function getDisponible(): ?string
    {
        return $this->disponible;
    }

    public function setDisponible(string $disponible): self
    {
        $this->disponible = $disponible;

        return $this;
    }

    public function getPret(): ?Pret
    {
        return $this->pret;
    }

    public function setPret(Pret $pret): self
    {
        // set the owning side of the relation if necessary
        if ($pret->getLivre() !== $this) {
            $pret->setLivre($this);
        }

        $this->pret = $pret;

        return $this;
    }
}
