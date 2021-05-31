<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\MvcProjectHighscoreRepository;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use App\Entity\MvcProjectHighscore;
use App\Game\GameRules;

/**
 * @codeCoverageIgnore
 */
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
        $idRes = $this->repository->findBy(
            [],
            ['id' => 'DESC'],
            1
        );

        $id = 0;

        if ($idRes[0] ?? null) {
            $id = $idRes[0]->getGameNumber();
        }

        $this->session->set("gameNumber", $id);

        return $this->redirectToRoute('rpg_index');
    }

    /**
     * @Route("/highscore", name="show_highscore")
     */
    public function showHighscore(): Response
    {
        $res = $this->repository->findBy(
            [],
            ['score' => 'DESC'],
            GameRules::HIGHSCORE_LIMIT
        );

        return $this->render('highscore/index.html.twig', [
            'header' => 'Highscore',
            'data' => $res
        ]);
    }

    /**
     * @Route("/save/highscore", name="save_highscore", methods={"POST"})
     */
    public function save_highscorePost(): Response
    {
        $score = $this->session->get('toHighscore');

        $this->addHighscore(
            $score["gameNumber"],
            $score["name"],
            $score["kills"],
            $score["heal"],
            $score["damageDealt"],
            $score["damageTaken"],
            $score["score"],
            $score["exp"]
        );

        $this->session->clear();


        return $this->redirectToRoute('rpg_index');
    }

    public function addHighscore(
        int $gameNumber,
        string $name,
        int $kills,
        int $heal,
        int $damageDealt,
        int $damageTaken,
        int $score,
        int $exp
    )
    {
        // you can fetch the EntityManager via $this->getDoctrine()
        // or you can add an argument to the action: createBook(EntityManagerInterface $entityManager)
        $entityManager = $this->getDoctrine()->getManager();

        $highscore = new MvcProjectHighscore();
        $highscore->setGameNumber($gameNumber);
        $highscore->setName($name);
        $highscore->setKills($kills);
        $highscore->setHeal($heal);
        $highscore->setDamageDealt($damageDealt);
        $highscore->setDamageTaken($damageTaken);
        $highscore->setScore($score);
        $highscore->setExp($exp);

        // tell Doctrine you want to (eventually) save the Product (no queries yet)
        $entityManager->persist($highscore);

        // actually executes the queries (i.e. the INSERT query)
        $entityManager->flush();

    }
}
