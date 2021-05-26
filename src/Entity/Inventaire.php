<?php

namespace App\Entity;

use App\Repository\InventaireRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=InventaireRepository::class)
 */
class Inventaire
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    public $id;

    /**
     * @ORM\OneToMany(targetEntity=Materiel::class, mappedBy="inventaire")
     */
    public $materiel;

    /**
     * @ORM\OneToOne(targetEntity=Unite::class, cascade={"persist", "remove"})
     */
    private $Unite;

    
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
            $materiel->setInventaire($this);
        }

        return $this;
    }

    public function removeMateriel(Materiel $materiel): self
    {
        if ($this->materiel->removeElement($materiel)) {
            // set the owning side to null (unless already changed)
            if ($materiel->getInventaire() === $this) {
                $materiel->setInventaire(null);
            }
        }

        return $this;
    }

    public function getUnite(): ?Unite
    {
        return $this->Unite;
    }

    public function setUnite(?Unite $Unite): self
    {
        $this->Unite = $Unite;

        return $this;
    }

    

}
