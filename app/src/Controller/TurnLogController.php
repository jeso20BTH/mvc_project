<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\MvcProjectTurnLogRepository;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use App\Entity\MvcProjectTurnLog;

class TurnLogController extends AbstractController
{
    private $repository;

    public function __construct(
        SessionInterface $session,
        MvcProjectTurnLogRepository $turnLogRepository
        )
    {
        $this->repository = $turnLogRepository;
        $this->session = $session;
    }

    /**
     * @Route("/turn/log", name="turn_log")
     */
    public function index(): Response
    {
        return $this->render('turn_log/index.html.twig', [
            'controller_name' => 'TurnLogController',
        ]);
    }

    /**
     * @Route("/log/turn/{game}/{returnRoute}", name="log_turn", methods={"GET", "HEAD"})
     */
    public function viewTurnLog(int $game, string $returnRoute): Response
    {
        $turns = $this->repository->findAll();
        var_dump($turns);
        return $this->render('turn_log/index.html.twig', [
            'header' => 'Turns',
            'turns' => $turns
        ]);
    }

    /**
     * @Route("/save/turn", name="save_turn", methods={"GET", "HEAD"})
     */
    public function add(): Response
    {
        $res = $this->session->get('toDB');
        var_dump($res);
        $this->addToLog(
            $res["playerName"],
            $res["monsterName"],
            $res["playerDamage"],
            $res["monsterDamage"],
            $res["playerHealth"],
            $res["monsterHealth"],
            $res["gameNumber"],
        );

         $this->session->set('toDB', null);

        return $this->redirectToRoute('rpg_battle');
    }

    public function addToLog(
        string $playerName,
        string $monsterName,
        int $playerDamage,
        int $monsterDamage,
        int $playerHealthGain,
        int $monsterHealthGain,
        int $gameNumber): void
    {
        // you can fetch the EntityManager via $this->getDoctrine()
        // or you can add an argument to the action: createBook(EntityManagerInterface $entityManager)
        $entityManager = $this->getDoctrine()->getManager();

        $turnLog = new MvcProjectTurnLog();
        $turnLog->setPlayerName($playerName);
        $turnLog->setMonsterName($monsterName);
        $turnLog->setPlayerDamage($playerDamage);
        $turnLog->setMonsterDamage($monsterDamage);
        $turnLog->setPlayerHealthGain($playerHealthGain);
        $turnLog->setMonsterHealthGain($monsterHealthGain);
        $turnLog->setGameNumber($gameNumber);

        // tell Doctrine you want to (eventually) save the Product (no queries yet)
        $entityManager->persist($turnLog);

        // actually executes the queries (i.e. the INSERT query)
        $entityManager->flush();
    }
}
