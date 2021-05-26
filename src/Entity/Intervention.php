<?php

namespace App\Entity;

use App\Repository\InterventionRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=InterventionRepository::class)
 */
class Intervention
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    public $id;

    /**
     * @ORM\OneToMany(targetEntity=Materiel::class, mappedBy="intervention")
     */
    private $materiel;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $type;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $date;

    /**
     * @ORM\Column(type="integer")
     */
    private $nombrepr;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $listepr;

    /**
     * @ORM\ManyToMany(targetEntity=PiecesDeRechange::class, mappedBy="Intervention")
     */
    public $piecesDeRechanges;

    /**
     * @ORM\ManyToOne(targetEntity=PiecesDeRechange::class, inversedBy="intervention")
     */
    private $piecesDeRechange;

    public function __construct()
    {
        $this->materiel = new ArrayCollection();
        $this->piecesDeRechanges = new ArrayCollection();
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
            $materiel->setIntervention($this);
        }

        return $this;
    }

    public function removeMateriel(Materiel $materiel): self
    {
        if ($this->materiel->removeElement($materiel)) {
            // set the owning side to null (unless already changed)
            if ($materiel->getIntervention() === $this) {
                $materiel->setIntervention(null);
            }
        }

        return $this;
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

    public function getDate(): ?string
    {
        return $this->date;
    }

    public function setDate(string $date): self
    {
        $this->date = $date;

        return $this;
    }

    public function getNombrepr(): ?int
    {
        return $this->nombrepr;
    }

    public function setNombrepr(int $nombrepr): self
    {
        $this->nombrepr = $nombrepr;

        return $this;
    }

    public function getListepr(): ?string
    {
        return $this->listepr;
    }

    public function setListepr(string $listepr): self
    {
        $this->listepr = $listepr;

        return $this;
    }

    /**
     * @return Collection|PiecesDeRechange[]
     */
    public function getPiecesDeRechanges(): Collection
    {
        return $this->piecesDeRechanges;
    }

    public function addPiecesDeRechange(PiecesDeRechange $piecesDeRechange): self
    {
        if (!$this->piecesDeRechanges->contains($piecesDeRechange)) {
            $this->piecesDeRechanges[] = $piecesDeRechange;
            $piecesDeRechange->addIntervention($this);
        }

        return $this;
    }

    public function removePiecesDeRechange(PiecesDeRechange $piecesDeRechange): self
    {
        if ($this->piecesDeRechanges->removeElement($piecesDeRechange)) {
            $piecesDeRechange->removeIntervention($this);
        }

        return $this;
    }

    public function getPiecesDeRechange(): ?PiecesDeRechange
    {
        return $this->piecesDeRechange;
    }

    public function setPiecesDeRechange(?PiecesDeRechange $piecesDeRechange): self
    {
        $this->piecesDeRechange = $piecesDeRechange;

        return $this;
    }
}
