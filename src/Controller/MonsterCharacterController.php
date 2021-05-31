<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use App\Repository\MvcProjectMonsterCharacterRepository;
use App\Repository\MvcProjectMonsterDiceRepository;

/**
 * @codeCoverageIgnore
 */
class MonsterCharacterController extends AbstractController
{
    private object $session;
    private $monsterRepository;
    private $diceRepository;

    public function __construct(
        SessionInterface $session,
        MvcProjectMonsterCharacterRepository $monsterRepository,
        MvcProjectMonsterDiceRepository $diceRepository
        )
    {
        $this->session = $session;
        $this->monsterRepository = $monsterRepository;
        $this->diceRepository = $diceRepository;
    }

    /**
     * @Route("/monster/character", name="monster_character")
     */
    public function index(): Response
    {
        return $this->render('monster_character/index.html.twig', [
            'controller_name' => 'MonsterCharacterController',
        ]);
    }

    /**
     * @Route("/monster/load", name="monster_load")
     */
    public function monsterLoad(): Response
    {
        $monsters = $this->monsterRepository->findAll();

        $monsterArray = [];

        foreach ($monsters as $monster) {
            $diceArray = [];
            $dices = $this->diceRepository->findBy(
                ['monsterId' => $monster->getID()]
            );

            foreach ($dices as $dice) {
                $diceArray[] = [
                    'type' => $dice->getDice(),
                    'faces' => $dice->getFaces()
                ];
            }
            $monsterArray[] = [
                'name' => $monster->getName(),
                'hpPercentage' => $monster->getHp(),
                'exp' => $monster->getExperience(),
                'dices' => $diceArray
            ];
        }

        $this->session->set('allMonsters', $monsterArray);

        return $this->redirectToRoute('rpg_new');
    }
}
