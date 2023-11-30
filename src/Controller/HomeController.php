<?php

namespace App\Controller;

use App\Repository\GameRepository;
use App\Repository\MovieRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(GameRepository $gameRepository, MovieRepository $movieRepository): Response
    {
        $cover = [];
        $gamesPictures = $gameRepository->getImages();
        $moviesPictures = $movieRepository->getImages();
        array_push($cover, $gamesPictures[array_rand($gamesPictures)]);
        array_push($cover, $moviesPictures[array_rand($moviesPictures)]);
        $cover = $cover[array_rand($cover)];
        return $this->render('home/index.html.twig', [
            'picture' => $cover['picture'],
            'games' => $gameRepository->findAll(),
            'movies' => $movieRepository->findAll()
        ]);
    }
}
