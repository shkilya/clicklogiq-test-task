<?php
declare(strict_types=1);

namespace App\Controller;


use App\Repository\HazardousAsteroidsRepository;
use App\Utils\Managers\HazardousAsteroidsApiManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class IndexController
 * @package App\Controller
 */
class IndexController extends AbstractController
{

    private const PARAM_LIMIT = 'limit';
    private const PARAM_PAGE = 'page';

    private const DEFAULT_LIMIT = 20;

    /**
     * @var HazardousAsteroidsRepository
     */
    private $hazardousAsteroidsRepository;

    /**
     * IndexController constructor.
     * @param HazardousAsteroidsRepository $hazardousAsteroidsRepository
     */
    public function __construct(
        HazardousAsteroidsRepository $hazardousAsteroidsRepository
    )
    {
        $this->hazardousAsteroidsRepository = $hazardousAsteroidsRepository;
    }


    /**
     * @Route(path="/")
     */
    public function index()
    {

    }

    /**
     * @Route(path="/neo/hazardous")
     * @param Request $request
     * @return JsonResponse
     */
    public function hazardous(Request $request)
    {
        $limit = (int)$request->get(self::PARAM_LIMIT,self::DEFAULT_LIMIT);
        $page = (int)$request->get(self::PARAM_PAGE,1);

        return $this->json([
            $this->hazardousAsteroidsRepository->getAll(($page-1)*$limit,$limit)
        ]);
    }

    /**
     * @Route(path="/neo/fastest")
     * @param Request $request
     * @return JsonResponse
     */
    public function fastest(Request $request)
    {
        $isHazardous = filter_var($request->get('hazardous',false), FILTER_VALIDATE_BOOLEAN, FILTER_NULL_ON_FAILURE);
        return $this->json([
            $this->hazardousAsteroidsRepository->getFasterAsteroid($isHazardous)
        ]);
    }


    /**
     * @Route(path="/neo/best-month")
     */
    public function bestMonth(Request $request)
    {
        $isHazardous = filter_var($request->get('hazardous',false), FILTER_VALIDATE_BOOLEAN, FILTER_NULL_ON_FAILURE);
        return $this->json([
            $this->hazardousAsteroidsRepository->getBestMonth($isHazardous)
        ]);
    }
}