<?php

namespace App\Controller;

use App\Entity\Game;
use App\Form\GameType;
use App\Repository\GameRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/games')]
class GameController extends AbstractController
{
    #[Route('/', name: 'app_game_index', methods: ['GET'])]
    public function index(GameRepository $gameRepository): Response
    {
        $images = $gameRepository->getImages();
        $cover = $images[array_rand($images)];
        return $this->render('game/index.html.twig', [
            'gamesDone' => $gameRepository->getDone(),
            'gamesNotDone' => $gameRepository->getNotDone(),
            'cover' => $cover['image']
        ]);
    }

    #[Route('/backlog', name: 'app_game_backlog', methods: ['GET'])]
    public function backlog(GameRepository $gameRepository): Response
    {
        $images = $gameRepository->getImages();
        $cover = $images[array_rand($images)];
        $games = $gameRepository->getByMonth();
        $gamesByMonth = ['Janvier' => [], 'Février' => [], 'Mars' => [], 'Avril' => [], 'Mai' => [], 'Juin' => [], 'Juillet' => [], 'Aout' => [], 'Septembre' =>[], 'Octobre'=>[], 'Novembre'=>[], 'Décembre'=>[]];
        $i = 1;
        foreach ($gamesByMonth as $key=>$value) {
            foreach ($games as $game) {
                $gameMonth = $game->getMonth();
                if($gameMonth === $i) {
                    array_push($gamesByMonth[$key], $game);
                }
            }
            $i++;
        }
        return $this->render('game/backlog.html.twig', [
            'cover' => $cover['image'],
            'games' => $gamesByMonth
        ]);
    }

    #[Route('/new', name: 'app_game_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $game = new Game();
        $form = $this->createForm(GameType::class, $game);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($game);
            $entityManager->flush();

            return $this->redirectToRoute('app_game_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('game/new.html.twig', [
            'game' => $game,
            'form' => $form,
        ]);
    }

    #[Route('/{slug}', name: 'app_game_show', methods: ['GET'])]
    public function show(Game $game): Response
    {
        return $this->render('game/show.html.twig', [
            'game' => $game
        ]);
    }

    #[Route('/{id}/edit', name: 'app_game_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Game $game, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(GameType::class, $game);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_game_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('game/edit.html.twig', [
            'game' => $game,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_game_delete', methods: ['POST'])]
    public function delete(Request $request, Game $game, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete' . $game->getId(), $request->request->get('_token'))) {
            $entityManager->remove($game);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_game_index', [], Response::HTTP_SEE_OTHER);
    }

    #[Route('/done/{slug}', name: 'app_game_done', methods: ['GET'])]
    public function done(Game $game, EntityManagerInterface $entityManager): Response
    {
        $game->isDone() ? $game->setDone(0) : $game->setDone(1);
        $entityManager->persist($game);
        $entityManager->flush();

        return $this->json(['isTrue' => $game->isDone()]);
    }

    #[Route('/liked/{slug}', name: 'app_game_liked', methods: ['GET'])]
    public function liked(Game $game, EntityManagerInterface $entityManager): Response
    {
        $game->isLiked() ? $game->setLiked(0) : $game->setLiked(1);
        if ($game->isLiked() && !$game->isDone()) $game->setDone(1);
        $entityManager->persist($game);
        $entityManager->flush();

        return $this->json(['isTrue' => $game->isLiked()]);
    }
}
