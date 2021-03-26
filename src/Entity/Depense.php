<?php

namespace App\Entity;

use App\Repository\DepenseRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=DepenseRepository::class)
 * @ORM\Table(name="depenses")
 */
class Depense
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=25)
     */
    private $nom;

    /**
     * @ORM\Column(type="date")
     */
    private $dateDepense;

    /**
     * @ORM\Column(type="float")
     */
    private $nontant;

    /**
     * @ORM\ManyToOne(targetEntity=Devise::class, inversedBy="depenses")
     * @ORM\JoinColumn(nullable=false)
     */
    private $devise;

    /**
     * @ORM\ManyToOne(targetEntity=TypeDepense::class, inversedBy="depenses")
     * @ORM\JoinColumn(nullable=false)
     */
    private $typeDepense;

    /**
     * @ORM\ManyToOne(targetEntity=TypePaiement::class, inversedBy="depenses")
     * @ORM\JoinColumn(nullable=false)
     */
    private $typePaiement;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $description;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getDateDepense(): ?\DateTimeInterface
    {
        return $this->dateDepense;
    }

    public function setDateDepense(\DateTimeInterface $dateDepense): self
    {
        $this->dateDepense = $dateDepense;

        return $this;
    }

    public function getNontant(): ?float
    {
        return $this->nontant;
    }

    public function setNontant(float $nontant): self
    {
        $this->nontant = $nontant;

        return $this;
    }

    public function getDevise(): ?Devise
    {
        return $this->devise;
    }

    public function setDevise(?Devise $devise): self
    {
        $this->devise = $devise;

        return $this;
    }

    public function getTypeDepense(): ?TypeDepense
    {
        return $this->typeDepense;
    }

    public function setTypeDepense(?TypeDepense $typeDepense): self
    {
        $this->typeDepense = $typeDepense;

        return $this;
    }

    public function getTypePaiement(): ?TypePaiement
    {
        return $this->typePaiement;
    }

    public function setTypePaiement(?TypePaiement $typePaiement): self
    {
        $this->typePaiement = $typePaiement;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }
}
