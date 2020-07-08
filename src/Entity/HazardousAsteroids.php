<?php

namespace App\Entity;

use App\Repository\HazardousAsteroidsRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=HazardousAsteroidsRepository::class)
 * @ORM\Table(name="hazardous_asteroids")
 */
class HazardousAsteroids
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @var \DateTimeInterface
     *
     * @ORM\Column(type="date")
     */
    private $date;

    /**
     * @var int
     *
     * @ORM\Column(type="integer",unique=true)
     */
    private $neoReferenceId;

    /**
     * @var string
     *
     * @ORM\Column(type="string")
     */
    private $name;

    /**
     * @var float
     *
     * @ORM\Column(type="float")
     */
    private $kilometersPerHour;

    /**
     * @var bool
     *
     * @ORM\Column(type="boolean")
     */
    private $isPotentiallyHazardousAsteroid;

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return \DateTimeInterface
     */
    public function getDate(): \DateTimeInterface
    {
        return $this->date;
    }

    /**
     * @param \DateTimeInterface $date
     * @return $this
     */
    public function setDate(\DateTimeInterface $date): self
    {
        $this->date = $date;
        return $this;
    }

    /**
     * @return int
     */
    public function getNeoReferenceId(): int
    {
        return $this->neoReferenceId;
    }

    /**
     * @param int $neoReferenceId
     * @return $this
     */
    public function setNeoReferenceId(int $neoReferenceId): self
    {
        $this->neoReferenceId = $neoReferenceId;
        return $this;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return $this
     */
    public function setName(string $name): self
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return float
     */
    public function getKilometersPerHour(): float
    {
        return $this->kilometersPerHour;
    }

    /**
     * @param float $kilometersPerHour
     * @return $this
     */
    public function setKilometersPerHour(float $kilometersPerHour): self
    {
        $this->kilometersPerHour = $kilometersPerHour;
        return $this;
    }

    /**
     * @return bool
     */
    public function isPotentiallyHazardousAsteroid(): bool
    {
        return $this->isPotentiallyHazardousAsteroid;
    }

    /**
     * @param bool $isPotentiallyHazardousAsteroid
     * @return $this
     */
    public function setIsPotentiallyHazardousAsteroid(bool $isPotentiallyHazardousAsteroid): self
    {
        $this->isPotentiallyHazardousAsteroid = $isPotentiallyHazardousAsteroid;
        return $this;
    }

}
