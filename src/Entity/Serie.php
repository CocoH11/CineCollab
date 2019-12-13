<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\SerieRepository")
 */
class Serie
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $nbEpisodes;

    /**
     * @ORM\Column(type="integer")
     */
    private $nbSaisons;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNbEpisodes(): ?int
    {
        return $this->nbEpisodes;
    }

    public function setNbEpisodes(int $nbEpisodes): self
    {
        $this->nbEpisodes = $nbEpisodes;

        return $this;
    }

    public function getNbSaisons(): ?int
    {
        return $this->nbSaisons;
    }

    public function setNbSaisons(int $nbSaisons): self
    {
        $this->nbSaisons = $nbSaisons;

        return $this;
    }
}
