<?php

namespace App\Entity;

use App\Repository\MaterielRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=MaterielRepository::class)
 */
class Materiel
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    public $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    public $type;

    /**
     * @ORM\Column(type="string", length=255)
     */
    public $date_dacquisition;

    /**
     * @ORM\Column(type="string", length=255)
     */
    public $affectation;

    /**
     * @ORM\Column(type="string", length=255)
     */
    public $etat;

    /**
     * @ORM\ManyToOne(targetEntity=Unite::class, inversedBy="materiels")
     */
    public $unite;

    /**
     * @ORM\ManyToOne(targetEntity=Inventaire::class, inversedBy="materiel")
     */
    private $inventaire;

    /**
     * @ORM\ManyToOne(targetEntity=BonDeCommande::class, inversedBy="materiel")
     */
    private $bonDeCommande;

    /**
     * @ORM\ManyToOne(targetEntity=Intervention::class, inversedBy="materiel")
     */
    private $intervention;


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): self
    {
        $this->type = $type;

        return $this;
    }

    public function getDateDacquisition(): ?string
    {
        return $this->date_dacquisition;
    }

    public function setDateDacquisition(string $date_dacquisition): self
    {
        $this->date_dacquisition = $date_dacquisition;

        return $this;
    }

    public function getAffectation(): ?string
    {
        return $this->affectation;
    }

    public function setAffectation(string $affectation): self
    {
        $this->affectation = $affectation;

        return $this;
    }

    public function getEtat(): ?string
    {
        return $this->etat;
    }

    public function setEtat(string $etat): self
    {
        $this->etat = $etat;

        return $this;
    }

    public function getUnite(): ?Unite
    {
        return $this->unite;
    }

    public function setUnite(?Unite $unite): self
    {
        $this->unite = $unite;

        return $this;
    }

    public function getInventaire(): ?Inventaire
    {
        return $this->inventaire;
    }

    public function setInventaire(?Inventaire $inventaire): self
    {
        $this->inventaire = $inventaire;

        return $this;
    }

    public function getBonDeCommande(): ?BonDeCommande
    {
        return $this->bonDeCommande;
    }

    public function setBonDeCommande(?BonDeCommande $bonDeCommande): self
    {
        $this->bonDeCommande = $bonDeCommande;

        return $this;
    }

    public function getIntervention(): ?Intervention
    {
        return $this->intervention;
    }

    public function setIntervention(?Intervention $intervention): self
    {
        $this->intervention = $intervention;

        return $this;
    }


}
