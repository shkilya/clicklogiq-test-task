<?php
declare(strict_types=1);

namespace App\Models\Api\HazardousAsteroid;

use JMS\Serializer\Annotation as Serializer;

/**
 * Class Links
 * @package App\Models\HazardousAsteroid
 */
final class Links
{
    /**
     * @var string
     *
     * @Serializer\Type("string")
     */
    private $next;

    /**
     * @var string
     *
     * @Serializer\Type("string")
     */
    private $prev;

    /**
     * @var string
     *
     * @Serializer\Type("string")
     */
    private $self;

    private function __construct()
    {
    }

    /**
     * @return string
     */
    public function getNext(): string
    {
        return $this->next;
    }

    /**
     * @return string
     */
    public function getPrev(): string
    {
        return $this->prev;
    }

    /**
     * @return string
     */
    public function getSelf(): string
    {
        return $this->self;
    }
}