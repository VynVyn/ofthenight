<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use Symfony\Component\EventDispatcher\EventDispatcher;

use Tmdb\Client;
use Tmdb\Event\BeforeRequestEvent;
use Tmdb\Event\Listener\Request\AcceptJsonRequestListener;
use Tmdb\Event\Listener\Request\ApiTokenRequestListener;
use Tmdb\Event\Listener\Request\ContentTypeJsonRequestListener;
use Tmdb\Event\Listener\Request\UserAgentRequestListener;
use Tmdb\Event\Listener\RequestListener;
use Tmdb\Event\RequestEvent;
use Tmdb\Token\Api\ApiToken;
use Tmdb\Token\Api\BearerToken;
use Tmdb\Repository\MovieRepository;


class IndexController extends AbstractController
{

    /**
     * @Route("/", name="app_index")
     */
    public function index(): Response
    {


        $client = require_once('C:/laragon/www/ofthenight/src/setup-client.php');
        $repository = new MovieRepository($client);

        $movie = $repository->load(1939);
       

        //$title = $movie->getTitle();

        $date = $movie->getReleaseDate()->format('Y');

        $poster = 'https://image.tmdb.org/t/p/w500'.$movie->getPosterImage();

        return $this->render('index/index.html.twig', [
            'controller_name' => 'IndexController', 'movie' => $movie, 'release_date' => $date, 'poster' => $poster,
        ]);
    }
}
