<?php
declare(strict_types=1);

namespace App\Models;

class HazardousAsteroid
{
    /**
     * @var \DateTimeInterface
     */
    private $date;

    /**
     * @var int
     */
    private $neoReferenceId;

    /**
     * @var string
     */
    private $name;

    /**
     * @var float
     */
    private $kilometersPerHour;

    /**
     * @var bool
     */
    private $isPotentiallyHazardousAsteroid;

    /**
     * HazardousAsteroid constructor.
     * @param \DateTimeInterface $date
     * @param int $neoReferenceId
     * @param string $name
     * @param float $kilometersPerHour
     * @param bool $isPotentiallyHazardousAsteroid
     */
    public function __construct(\DateTimeInterface $date, int $neoReferenceId, string $name, float $kilometersPerHour, bool $isPotentiallyHazardousAsteroid)
    {
        $this->date                           = $date;
        $this->neoReferenceId                 = $neoReferenceId;
        $this->name                           = $name;
        $this->kilometersPerHour              = $kilometersPerHour;
        $this->isPotentiallyHazardousAsteroid = $isPotentiallyHazardousAsteroid;
    }

    /**
     * @return \DateTimeInterface
     */
    public function getDate(): \DateTimeInterface
    {
        return $this->date;
    }

    /**
     * @return int
     */
    public function getNeoReferenceId(): int
    {
        return $this->neoReferenceId;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return float
     */
    public function getKilometersPerHour(): float
    {
        return $this->kilometersPerHour;
    }

    /**
     * @return bool
     */
    public function isPotentiallyHazardousAsteroid(): bool
    {
        return $this->isPotentiallyHazardousAsteroid;
    }
}