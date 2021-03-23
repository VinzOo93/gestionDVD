<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=FilterSortieRepository::class)
 */
class FilterSerie
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name = '';

    /**
     * @ORM\Column(type="boolean")
     */
    private $popularity = true;

    /**
     * @ORM\Column(type="boolean")
     */
    private $vote;

    /**
     * @ORM\Column(type="Genres", length=255)
     */
    private $genres = '';

    /**
     * @ORM\Column(type="boolean")
     */
    private $LastAirDate;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getPopularity(): ?bool
    {
        return $this->popularity;
    }

    public function isVote(): ?bool
    {
        return $this->vote;
    }

    /**
     * @param bool $vote
     */
    public function setVote(bool $vote): ?self
    {
        $this->vote = $vote;
    }
    /**
     * @return bool
     */
    public function setPopularity(bool $popularity): self
    {
        $this->popularity = $popularity;

        return $this;
    }

    public function getGenres(): ?string
    {
        return $this->genres;
    }

    public function setGenres(string $genres): self
    {
        $this->genres = $genres;

        return $this;
    }

    Public function getLastAirDate(): ?bool
    {
        return $this->LastAirDate;
    }

    public function setLastAirDate(bool $LastAirDate): self
    {
        $this->LastAirDate = $LastAirDate;

        return $this;
    }
}
