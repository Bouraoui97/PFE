<?php

namespace App\Entity;

use App\Repository\BonDeCommandeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=BonDeCommandeRepository::class)
 */
class BonDeCommande
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\OneToMany(targetEntity=Materiel::class, mappedBy="bonDeCommande")
     */
    private $materiel;

    /**
     * @ORM\Column(type="integer")
     */
    public $numbc;

    /**
     * @ORM\Column(type="integer")
     */
    private $nmbrmat;

    /**
     * @ORM\Column(type="float")
     */
    private $prix;

    public function __construct()
    {
        $this->materiel = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Collection|Materiel[]
     */
    public function getMateriel(): Collection
    {
        return $this->materiel;
    }

    public function addMateriel(Materiel $materiel): self
    {
        if (!$this->materiel->contains($materiel)) {
            $this->materiel[] = $materiel;
            $materiel->setBonDeCommande($this);
        }

        return $this;
    }

    public function removeMateriel(Materiel $materiel): self
    {
        if ($this->materiel->removeElement($materiel)) {
            // set the owning side to null (unless already changed)
            if ($materiel->getBonDeCommande() === $this) {
                $materiel->setBonDeCommande(null);
            }
        }

        return $this;
    }

    public function getNumbc(): ?int
    {
        return $this->numbc;
    }

    public function setNumbc(int $numbc): self
    {
        $this->numbc = $numbc;

        return $this;
    }

    public function getNmbrmat(): ?int
    {
        return $this->nmbrmat;
    }

    public function setNmbrmat(int $nmbrmat): self
    {
        $this->nmbrmat = $nmbrmat;

        return $this;
    }

    public function getPrix(): ?float
    {
        return $this->prix;
    }

    public function setPrix(float $prix): self
    {
        $this->prix = $prix;

        return $this;
    }
}
