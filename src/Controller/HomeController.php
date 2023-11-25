<?php

namespace App\Controller;

use App\Repository\GameRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(GameRepository $gameRepository): Response
    {
        $images = $gameRepository->getImages();
        $cover = $images[array_rand($images)];
        return $this->render('home/index.html.twig', [
            'cover' => $cover['image'],
            'games' => $gameRepository->findAll()
        ]);
    }
}
