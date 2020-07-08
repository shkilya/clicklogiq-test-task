<?php
declare(strict_types=1);

namespace App\Models\Api\HazardousAsteroid;

use JMS\Serializer\Annotation as Serializer;

/**
 * Class NearEarthObject
 * @package App\Models\Api\HazardousAsteroid
 */
class NearEarthObject
{
    /**
     * @var \DateTimeInterface
     *
     * @Serializer\Type("DateTimeImmutable")
     */
    private $date;

    /**
     * @var int
     *
     * @Serializer\Type("int")
     */
    private $neoReferenceId;

    /**
     * @var string
     *
     * @Serializer\Type("string")
     */
    private $name;

    /**
     * @var CloseApproachData[]
     *
     * @Serializer\Type("array<App\Models\Api\HazardousAsteroid\CloseApproachData>")
     */
    private $closeApproachData;

    /**
     * @var bool
     *
     * @Serializer\Type("bool")
     */
    private $isPotentiallyHazardousAsteroid;

    private function __construct()
    {
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
     * @return CloseApproachData[]
     */
    public function getCloseApproachData(): array
    {
        return $this->closeApproachData;
    }

    /**
     * @return bool
     */
    public function isPotentiallyHazardousAsteroid(): bool
    {
        return $this->isPotentiallyHazardousAsteroid;
    }
}