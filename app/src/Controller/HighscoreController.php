<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\MvcProjectHighscoreRepository;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class HighscoreController extends AbstractController
{
    private $repository;
    private object $session;

    public function __construct(MvcProjectHighscoreRepository $highscoreRepository, SessionInterface $session)
    {
        $this->repository = $highscoreRepository;
        $this->session = $session;
    }
    /**
     * @Route("/set-game-number", name="set_game_number")
     */
    public function setGameNumber(): Response
    {
        $id = $this->repository->findBy(
            ['id' => 'DESC'],
            null,
            1
        );

        $id = $id["id"] ?? 0;

        $this->session->set("gameNumber", $id);

        return $this->redirectToRoute('rpg_index');
    }
}
