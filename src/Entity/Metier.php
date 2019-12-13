<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\MetierRepository")
 */
class Metier
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $libelle;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Personnalite", inversedBy="metiers")
     */
    private $personnalites;

    public function __construct()
    {
        $this->personnalites = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLibelle(): ?string
    {
        return $this->libelle;
    }

    public function setLibelle(string $libelle): self
    {
        $this->libelle = $libelle;

        return $this;
    }

    /**
     * @return Collection|Personnalite[]
     */
    public function getPersonnalites(): Collection
    {
        return $this->personnalites;
    }

    public function addPersonnalite(Personnalite $personnalite): self
    {
        if (!$this->personnalites->contains($personnalite)) {
            $this->personnalites[] = $personnalite;
        }

        return $this;
    }

    public function removePersonnalite(Personnalite $personnalite): self
    {
        if ($this->personnalites->contains($personnalite)) {
            $this->personnalites->removeElement($personnalite);
        }

        return $this;
    }
}
