<?php
declare(strict_types=1);

namespace App\Models\Api\HazardousAsteroid;

use JMS\Serializer\Annotation as Serializer;

/**
 * Class RelativeVelocity
 * @package App\Models\HazardousAsteroid
 */
final class RelativeVelocity
{
    /**
     * @var float
     *
     * @Serializer\Type("float")
     */
    private $kilometersPerHour;

    private function __construct()
    {
    }

    /**
     * @return float
     */
    public function getKilometersPerHour(): float
    {
        return $this->kilometersPerHour;
    }
}