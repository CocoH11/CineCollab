<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\FilmRepository")
 */
class Film
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
    private $titre;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $duree;

    /**
     * @ORM\Column(type="text")
     */
    private $resume;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $titreOriginal;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $affiche;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Genre", inversedBy="films")
     */
    private $genres;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Nationalite", inversedBy="films")
     */
    private $nationalites;

    public function __construct()
    {
        $this->genres = new ArrayCollection();
        $this->nationalites = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitre(): ?string
    {
        return $this->titre;
    }

    public function setTitre(string $titre): self
    {
        $this->titre = $titre;

        return $this;
    }

    public function getDuree(): ?string
    {
        return $this->duree;
    }

    public function setDuree(string $duree): self
    {
        $this->duree = $duree;

        return $this;
    }

    public function getResume(): ?string
    {
        return $this->resume;
    }

    public function setResume(string $resume): self
    {
        $this->resume = $resume;

        return $this;
    }

    public function getTitreOriginal(): ?string
    {
        return $this->titreOriginal;
    }

    public function setTitreOriginal(string $titreOriginal): self
    {
        $this->titreOriginal = $titreOriginal;

        return $this;
    }

    public function getAffiche(): ?string
    {
        return $this->affiche;
    }

    public function setAffiche(?string $affiche): self
    {
        $this->affiche = $affiche;

        return $this;
    }

    /**
     * @return Collection|Genre[]
     */
    public function getGenres(): Collection
    {
        return $this->genres;
    }

    public function addGenre(Genre $genre): self
    {
        if (!$this->genres->contains($genre)) {
            $this->genres[] = $genre;
        }

        return $this;
    }

    public function removeGenre(Genre $genre): self
    {
        if ($this->genres->contains($genre)) {
            $this->genres->removeElement($genre);
        }

        return $this;
    }

    /**
     * @return Collection|Nationalite[]
     */
    public function getNationalites(): Collection
    {
        return $this->nationalites;
    }

    public function addNationalite(Nationalite $nationalite): self
    {
        if (!$this->nationalites->contains($nationalite)) {
            $this->nationalites[] = $nationalite;
        }

        return $this;
    }

    public function removeNationalite(Nationalite $nationalite): self
    {
        if ($this->nationalites->contains($nationalite)) {
            $this->nationalites->removeElement($nationalite);
        }

        return $this;
    }
}