<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\MvcProjectMonsterLogRepository;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use App\Entity\MvcProjectMonsterLog;

class MonsterLogController extends AbstractController
{
    private $repository;

    public function __construct(
        SessionInterface $session,
        MvcProjectMonsterLogRepository $monsterLogRepository
        )
    {
        $this->repository = $monsterLogRepository;
        $this->session = $session;
    }

    /**
     * @Route("/monster/log", name="monster_log")
     */
    public function index(): Response
    {
        return $this->render('turn_log/index.html.twig', [
            'controller_name' => 'TurnLogController',
        ]);
    }

    /**
     * @Route("/save/monster", name="save_monster", methods={"POST"})
     */
    public function add(): Response
    {
        $res = $this->session->get('toMonsterDB');
        var_dump($res);
        $this->addToMonsterLog(
            $res["name"],
            $res["hp"],
            $res["exp"],
            $res["dices"],
            $res["gameNumber"]
        );

         $this->session->set('toMonsterDB', null);

        return $this->redirectToRoute('rpg_turn');
    }

    public function addToMonsterLog(
        string $name,
        int $hp,
        int $exp,
        int $dices,
        int $gameNumber
        ): void
    {
        // you can fetch the EntityManager via $this->getDoctrine()
        // or you can add an argument to the action: createBook(EntityManagerInterface $entityManager)
        $entityManager = $this->getDoctrine()->getManager();

        $turnLog = new MvcProjectMonsterLog();
        $turnLog->setName($name);
        $turnLog->setHp($hp);
        $turnLog->setExp($exp);
        $turnLog->setDices($dices);
        $turnLog->setGameNumber($gameNumber);

        // tell Doctrine you want to (eventually) save the Product (no queries yet)
        $entityManager->persist($turnLog);

        // actually executes the queries (i.e. the INSERT query)
        $entityManager->flush();
    }
}
