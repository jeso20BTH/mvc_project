<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\MvcProjectLogRepository;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use App\Entity\MvcProjectLog;

/**
 * @codeCoverageIgnore
 */
class LogController extends AbstractController
{
    private $repository;
    private $session;

    public function __construct(
        SessionInterface $session,
        MvcProjectLogRepository $logRepository
        )
    {
        $this->repository = $logRepository;
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
     * @Route("/log/{game}/{returnRoute}", name="log_game", methods={"GET", "HEAD"})
     */
    public function viewTurnLog(int $game, string $returnRoute): Response
    {
        $turns = $this->repository->findBy(
            ['game_number' => $game],
            ['id' => 'DESC']
        );

        return $this->render('log/index.html.twig', [
            'header' => 'Log',
            'turns' => $turns,
            'returnRoute' => $returnRoute
        ]);
    }

    /**
     * @Route("/save/log", name="save_log", methods={"GET", "HEAD", "POST"})
     */
    public function add(): Response
    {
        $res = $this->session->get('toDB');
        foreach ($res as $row) {
            $this->addToLog(
                $row["time"],
                $row["name"],
                $row["monsterName"],
                $row["gameNumber"],
                $row["type"],
                $row["value"]
            );
        }

        $this->session->set('toDB', null);

        if ($res[0]["type"] === "kill") {
            return $this->redirectToRoute('rpg_turn');
        }

        return $this->redirectToRoute('rpg_battle');
    }

    public function addToLog(
        string $date,
        string $playerName,
        string $monsterName,
        int $gameNumber,
        string $type,
        int $value
        ): void
    {
        // you can fetch the EntityManager via $this->getDoctrine()
        // or you can add an argument to the action: createBook(EntityManagerInterface $entityManager)
        $entityManager = $this->getDoctrine()->getManager();

        if ($value !== 0) {
            $log = new MvcProjectLog();
            $log->setTime($date);
            $log->setName($playerName);
            $log->setMonsterName($monsterName);
            $log->setGameNumber($gameNumber);
            $log->setType($type);
            $log->setValue($value);

            // tell Doctrine you want to (eventually) save the Product (no queries yet)
            $entityManager->persist($log);

            // actually executes the queries (i.e. the INSERT query)
            $entityManager->flush();
        }


    }
}
