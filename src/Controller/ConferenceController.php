<?php
declare(strict_types=1);

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Contracts\HttpClient\ResponseInterface;

/**
 * Class ConferenceController
 * @package App\Controller
 */
class ConferenceController extends AbstractController
{
    /**
     * ConferenceController constructor.
     */
    public function __construct()
    {
    }

    /**
     * @return Response
     */
    public function index() : Response
    {
        return $this->render('conference/index.html.twig',[

        ]);
    }
}