<?php
declare(strict_types=1);

namespace App\Models\Api\HazardousAsteroid;

use JMS\Serializer\Annotation as Serializer;

/**
 * Class CloseApproachData
 * @package App\Models\HazardousAsteroid4
 */
final class CloseApproachData
{

    /**
     * @var RelativeVelocity
     *
     * @Serializer\Type("App\Models\Api\HazardousAsteroid\RelativeVelocity")
     */
    private $relativeVelocity;

    private function __construct()
    {
    }

    /**
     * @return RelativeVelocity
     */
    public function getRelativeVelocity(): RelativeVelocity
    {
        return $this->relativeVelocity;
    }


}