<?php
declare(strict_types=1);

namespace App\Models\Api;

use App\Models\Api\HazardousAsteroid\NearEarthObject;
use JMS\Serializer\Annotation as Serializer;

/**
 * Class HazardousAsteroidData
 * @package App\Models
 */
final class HazardousAsteroidData
{
    /**
     * @var string
     *
     * @Serializer\Type("App\Models\Api\HazardousAsteroid\Links")
     */
    private $links;

    /**
     * @var string
     *
     * @Serializer\Type("string")
     */
    private $elementCount;

    /**
     * @var array<string,array<NearEarthObject>>
     *
     * @Serializer\Type("array<string,array<App\Models\Api\HazardousAsteroid\NearEarthObject>>")
     */
    private $nearEarthObjects;

    private function __construct()
    {
    }

    /**
     * @return string
     */
    public function getLinks(): string
    {
        return $this->links;
    }

    /**
     * @return string
     */
    public function getElementCount(): string
    {
        return $this->elementCount;
    }

    /**
     * @return array
     */
    public function getNearEarthObjects(): array
    {
        return $this->nearEarthObjects;
    }


}