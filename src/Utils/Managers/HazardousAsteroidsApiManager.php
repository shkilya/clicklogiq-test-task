<?php
declare(strict_types=1);

namespace App\Utils\Managers;

use App\Models\Api\HazardousAsteroid\NearEarthObject;
use App\Models\Api\HazardousAsteroidData;
use App\Models\HazardousAsteroid;
use JMS\Serializer\SerializerInterface;
use Monolog\DateTimeImmutable;
use Psr\Log\LoggerInterface;
use Symfony\Contracts\HttpClient\HttpClientInterface;

/**
 * Class HazardousAsteroidsApiManager
 * @package App\Utils\Managers
 */
class HazardousAsteroidsApiManager
{
    /**
     * @var HttpClientInterface
     */
    private $client;
    /**
     * @var string
     */
    private $apiUrl;
    /**
     * @var string
     */
    private $apiKey;
    /**
     * @var LoggerInterface
     */
    private $logger;
    /**
     * @var SerializerInterface
     */
    private $serializer;

    /**
     * HazardousAsteroidsManager constructor.
     * @param HttpClientInterface $client
     * @param SerializerInterface $serializer
     * @param LoggerInterface $logger
     * @param string $apiUrl
     * @param string $apiKey
     */
    public function __construct(
        HttpClientInterface $client,
        SerializerInterface $serializer,
        LoggerInterface $logger,
        string $apiUrl,
        string $apiKey
    )
    {
        $this->client     = $client;
        $this->apiUrl     = $apiUrl;
        $this->apiKey     = $apiKey;
        $this->logger     = $logger;
        $this->serializer = $serializer;
    }

    /**
     * @param int $beforeDays
     * @return HazardousAsteroid[]
     * @throws \Symfony\Contracts\HttpClient\Exception\ClientExceptionInterface
     * @throws \Symfony\Contracts\HttpClient\Exception\RedirectionExceptionInterface
     * @throws \Symfony\Contracts\HttpClient\Exception\ServerExceptionInterface
     * @throws \Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface
     */
    public function getAll(int $beforeDays)
    {
        try {
            $response = $this->client->request(
                'GET',
                $this->apiUrl . '/neo/rest/v1/feed',
                [
                    'query' => [
                        'api_key'    => $this->apiKey,
                        'start_date' => (new \DateTime('-'.$beforeDays.' days'))->format('Y-m-d'),
                    ]
                ]
            );


            /** @var HazardousAsteroidData $hazardousAsteroidData */
            $hazardousAsteroidData = $this->serializer->deserialize(
                $response->getContent(),
                HazardousAsteroidData::class,
                'json'
            );


            foreach ($hazardousAsteroidData->getNearEarthObjects() as $date => $nearEarthObjects) {
                foreach ($nearEarthObjects as $nearEarthObject) {
                    /** @var NearEarthObject $nearEarthObject */

                    $firstCloseApproachData = $nearEarthObject->getCloseApproachData()[0];

                    $hazardousAsteroids[$nearEarthObject->getNeoReferenceId()] = new HazardousAsteroid(
                        DateTimeImmutable::createFromFormat('Y-m-d', $date),
                        $nearEarthObject->getNeoReferenceId(),
                        $nearEarthObject->getName(),
                        $firstCloseApproachData->getRelativeVelocity()->getKilometersPerHour(),
                        $nearEarthObject->isPotentiallyHazardousAsteroid()
                    );
                }
            }

            return $hazardousAsteroids;
        } catch (\Exception $exception) {
            $this->logger->critical('Nasa Api error', ['message' => $exception->getMessage()]);
            throw $exception;
        }
    }
}