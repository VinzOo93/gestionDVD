<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
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
    private $vote = false;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $genres = '';

    /**
     * @ORM\Column(type="boolean")
     */
    private $lastAirDate = false;

    /**
     * FilterSerie constructor.
     * @param string $genres
     */
    public function __construct(?string $genres)
    {
        $this->genres = $genres;
    }


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName():? string
    {
        return $this->name;
    }

    public function setName(?string $name): FilterSerie
    {
        $this->name = $name;

        return $this;
    }

    public function getPopularity(): bool
    {
        return $this->popularity;
    }

    public function isVote(): bool
    {
        return $this->vote;
    }



    /**
     * @param bool $vote
     */
    public function setVote(bool $vote): FilterSerie
    {
      $this->vote = $vote;

      return $this;
    }

    /**
     * @param bool $popularity
     * @return FilterSerie
     */
    public function setPopularity(bool $popularity): FilterSerie
    {
        $this->popularity = $popularity;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getGenres(): ?string
    {
        return $this->genres;
    }

    /**
     * @param string $genres
     */
    public function setGenres(?string $genres): FilterSerie
    {
        $this->genres = $genres;

        return $this;
    }



    Public function getLastAirDate(): ?bool
    {
        return $this->lastAirDate;
    }

    public function setLastAirDate(bool $lastAirDate): FilterSerie
    {
        $this->lastAirDate = $lastAirDate;

        return $this;
    }
}
