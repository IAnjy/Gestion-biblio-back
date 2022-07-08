<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\LecteurRepository;
use Doctrine\Common\Collections\Collection;
use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Annotation\ApiSubresource;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass=LecteurRepository::class)
 * @ApiResource(
 *  normalizationContext={
 *      "groups"={"lecteurs_read"}
 *  },
 *  attributes={
 *      "order":{"id":"desc"}      
 *  }
 * )
 */
class Lecteur
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups({"lecteurs_read", "prets_read", "books_read"})
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"lecteurs_read", "prets_read", "books_read"})
     */
    private $nomLecteur;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"lecteurs_read", "prets_read", "books_read"})
     */
    private $prenomLecteur;

    /**
     * @ORM\OneToMany(targetEntity=Pret::class, mappedBy="lecteur")
     * @Groups({"lecteurs_read"})
     * @ApiSubresource
     */
    private $prets;

    public function __construct()
    {
        $this->prets = new ArrayCollection();
    }

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

    /**
     * @return Collection|Pret[]
     */
    public function getPrets(): Collection
    {
        return $this->prets;
    }

    public function addPret(Pret $pret): self
    {
        if (!$this->prets->contains($pret)) {
            $this->prets[] = $pret;
            $pret->setLecteur($this);
        }

        return $this;
    }

    public function removePret(Pret $pret): self
    {
        if ($this->prets->removeElement($pret)) {
            // set the owning side to null (unless already changed)
            if ($pret->getLecteur() === $this) {
                $pret->setLecteur(null);
            }
        }

        return $this;
    }
}
