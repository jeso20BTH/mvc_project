<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use App\Repository\MvcProjectLogRepository;

use App\Game\Game;
use App\Game\Character;
use App\Game\GameRules;
use App\Game\Monster;

class RPGController extends AbstractController
{
    private object $session;
    private $repository;

    public function __construct(SessionInterface $session, MvcProjectLogRepository $logRepository)
    {
        $this->session = $session;
        $this->repository = $logRepository;
    }

    /**
     * @Route("/rpg", name="rpg_index")
    */
    public function rpg(): Response
    {
        if ($this->session->get('gameNumber') === null) {
            return $this->redirectToRoute('set_game_number');
        }

        return $this->render('menu.html.twig', [
            'header' => "Welcome!",
            'message' => 'Please start play'
        ]);
    }

    /**
     * @Route("/rpg/setup", name="rpg_new", methods={"GET", "HEAD"})
    */
    public function rpgNew(): Response
    {
        $curNumb = $this->session->get("gameNumber") + 1 ?? 1;
        $callable = $this->session->get('currentGame') ?? new Game($curNumb);

        $this->session->set('currentGame', $callable);

        $char = $this->session->get('charSetup');

        return $this->render('setup.html.twig', [
            'header' => "Welcome!",
            'message' => 'Please setup character!',
            'name' => $char["name"] ?? null,
            'stamina' => $char["stamina"] ?? 0,
            'strenght' => $char["strenght"] ?? 0,
            'agility' => $char["agility"] ?? 0,
            'max' => $char["max"] ?? null,
            'hp' => GameRules::INCREASE_HP ?? 0,
            'baseHP' => GameRules::BASE_HP ?? 0,
            'diceSides' => GameRules::INCREASE_DICE_SIDES ?? 0,
            'baseDiceSides' => GameRules::BASE_DICE_SIDES ?? 0,
            'dices' => GameRules::INCREASE_DICES ?? 0,
            'baseDices' => GameRules::BASE_DICES ?? 0
        ]);
    }

    /**
     * @Route("/rpg/turn", name="rpg_turn", methods={"GET", "HEAD"})
    */
    public function rpgTurn(): Response
    {
        $game = $this->session->get('currentGame');
        $currentGame = $game->getGame();
        $callable = $this->session->get('currentCharacter');
        $character = $callable->presentPlayer();

        return $this->render('turn.html.twig', [
            'header' => "Chose path",
            'character' => $character,
            'game' => $currentGame
        ]);
    }

    /**
     * @Route("/rpg/turn/menu", name="rpg_turn_menu", methods={"GET", "HEAD"})
    */
    public function rpgTurnMenu(): Response
    {
        $callable = $this->session->get('currentCharacter');
        $character = $callable->presentPlayer();

        return $this->render('base.html.twig', [
            'header' => "Chose path",
            'character' => $character,
        ]);
    }

    /**
     * @Route("/rpg/battle", name="rpg_battle", methods={"GET", "HEAD"})
    */
    public function rpgBattle(): Response
    {
        $character = $this->session->get('currentCharacter');
        $characterPres = $character->presentPlayer();
        $monster = $this->session->get('currentMonster');
        $monster = $monster->presentMonster();
        $game = $this->session->get('currentGame');
        $currentGame = $game->getGame();

        if ($characterPres['hp'] <= 0) {
            return $this->redirectToRoute('rpg_summary_game');
        } elseif ($monster['hp'] <= 0) {
            $character->addExp($monster['exp']);
            $levelUp = $character->levelUp($monster['exp']);
            $this->session->set('currentCharacter', $character);
            if ($levelUp) {
                return $this->redirectToRoute('rpg_level_up');
            }
            return $this->redirectToRoute('rpg_summary_monster');
        }


        return $this->render('battle.html.twig', [
            'header' => "Battle",
            'character' => $characterPres,
            'monster' => $monster,
            'game' => $currentGame
        ]);
    }

    /**
     * @Route("/rpg/summary/monster", name="rpg_summary_monster", methods={"GET", "HEAD"})
    */
    public function rpgSummaryMonster(): Response
    {
        $character = $this->session->get('currentCharacter');
        $character = $character->presentPlayer();
        $monster = $this->session->get('currentMonster');
        $monster = $monster->presentMonster();
        $game = $this->session->get('currentGame');

        $toDB = $game->summaryMonster($monster, $character["name"]);

        $this->session->set('toDB', $toDB);

        return $this->render('summary_monster.html.twig', [
            'header' => "Monster beaten!",
            'character' => $character,
            'monster' => $monster,
        ]);
    }

    /**
     * @Route("/rpg/backpack/{returnRoute}", name="rpg_backpack", methods={"GET", "HEAD"})
    */
    public function rpgBackpack(string $returnRoute): Response
    {
        $character = $this->session->get('currentCharacter');
        $character = $character->presentPlayer();

        return $this->render('backpack.html.twig', [
            'header' => "Backpack",
            'character' => $character,
            'allFood' => GameRules::FOOD,
            'returnRoute' => $returnRoute
        ]);
    }

    /**
     * @Route("/rpg/battle/levelup", name="rpg_level_up", methods={"GET", "HEAD"})
    */
    public function rpgLevelUp(): Response
    {
        $character = $this->session->get('currentCharacter');
        $characterPres = $character->presentPlayer();
        $characterStats = $character->getStats();
        $futureStats = $this->session->get('levelUp') ?? [
            'stamina' => $characterStats["stamina"],
            'strenght' => $characterStats["strenght"],
            'agility' => $characterStats["agility"],
            'max' => false,
            'usedPoints' => 0
        ];

        return $this->render('levelup.html.twig', [
            'header' => "Level Up",
            'name' => $characterPres["name"],
            'stamina' => $futureStats["stamina"] ?? 0,
            'staminaMin' => $characterStats["stamina"],
            'strenght' => $futureStats["strenght"] ?? 0,
            'strenghtMin' => $characterStats["strenght"],
            'agility' => $futureStats["agility"] ?? 0,
            'agilityMin' => $characterStats["agility"],
            'max' => $futureStats["max"],
            'usedPoints' => $futureStats["usedPoints"],
            'hp' => GameRules::INCREASE_HP ?? 0,
            'baseHP' => GameRules::BASE_HP ?? 0,
            'diceSides' => GameRules::INCREASE_DICE_SIDES ?? 0,
            'baseDiceSides' => GameRules::BASE_DICE_SIDES ?? 0,
            'dices' => GameRules::INCREASE_DICES ?? 0,
            'baseDices' => GameRules::BASE_DICES ?? 0
        ]);
    }

    /**
     * @Route("/rpg/summary/game", name="rpg_summary_game", methods={"GET", "HEAD"})
    */
    public function rpgGameOver(): Response
    {
        $game = $this->session->get('currentGame');
        $gameNumber=$game->getGame();

        $res = $this->repository->findBy(
            ['game_number' => $gameNumber],
            ['id' => 'DESC']
        );

        $summary = $game->gameSummary($res);

        $this->session->set('toHighscore', $summary);

        return $this->render('gameover.html.twig', [
            'header' => "Game Over",
            'summary' => $summary
        ]);
    }

    /**
     * @Route("/rpg/battle/levelup", name="rpg_level_up_post", methods={"POST"})
    */
    public function rpgLevelUpPost(): Response
    {
        $character = $this->session->get('currentCharacter');
        $characterPres = $character->presentPlayer();
        $characterStats = $character->getStats();
        $futureStats = $this->session->get('levelUp');

        $stamina = intval($_POST["stamina"]);
        $strenght = intval($_POST["strenght"]);
        $agility = intval($_POST["agility"]);

        $action = $_POST["action"];

        switch ($action) {
            case 'stamina-sub':
                $stamina--;
                break;
            case 'stamina-add':
                $stamina++;
                break;
            case 'strenght-sub':
                $strenght--;
                break;
            case 'strenght-add':
                $strenght++;
                break;
            case 'agility-sub':
                $agility--;
                break;
            case 'agility-add':
                $agility++;
                break;
        }

        $prevSum = $characterStats["stamina"] +
            $characterStats["strenght"] +
            $characterStats["agility"];

        $futureSum = $stamina + $strenght + $agility;

        $max = $futureSum - $prevSum >= GameRules::LEVEL_UP_POINTS;

        if ($_POST["action"] === "Confirm") {
            $callable = $this->session->get('currentGame');
            $stats = $callable ->generateStats($stamina, $strenght, $agility);
            $callable->getCharacter()->setStats($stats);
            $player = $callable->getCharacter();

            $this->session->set('currentCharacter', $player);
            $this->session->set('levelUp', null);

            return $this->redirectToRoute('rpg_summary_monster');
        }

        $this->session->set('levelUp', [
            'name' => $characterPres["name"],
            'stamina' => $stamina,
            'strenght' => $strenght,
            'agility' => $agility,
            'max' => $max,
            'usedPoints' => $futureSum - $prevSum
        ]);

        return $this->redirectToRoute('rpg_level_up');
    }

    /**
     * @Route("/rpg/setup", name="rpg_new_post", methods={"POST"})
    */
    public function rpgNewPost(): Response
    {
        $pointsToSet = GameRules::POINTS_TO_START;
        $name = $_POST["name"];
        $stamina = intval($_POST["stamina"]);
        $strenght = intval($_POST["strenght"]);
        $agility = intval($_POST["agility"]);

        $action = $_POST["action"];

        switch ($action) {
            case 'stamina-sub':
                $stamina--;
                break;
            case 'stamina-add':
                $stamina++;
                break;
            case 'strenght-sub':
                $strenght--;
                break;
            case 'strenght-add':
                $strenght++;
                break;
            case 'agility-sub':
                $agility--;
                break;
            case 'agility-add':
                $agility++;
                break;
        }

        $points = $stamina +$strenght + $agility;
        $max = $pointsToSet <= $points;

        $this->session->set('charSetup', [
            'name' => $name,
            'stamina' => $stamina,
            'strenght' => $strenght,
            'agility' => $agility,
            'max' => $max
        ]);

        if ($action == "Confirm") {
            $callable = $this->session->get('currentGame');


            $diceFaces = GameRules::BASE_DICE_SIDES + ($strenght * GameRules::INCREASE_DICE_SIDES);
            $noOfDices = GameRules::BASE_DICES + ($agility * GameRules::INCREASE_DICES);

            $hp = GameRules::BASE_HP + ($stamina * GameRules::INCREASE_HP);
            $exp = 0;
            $stats = $callable ->generateStats($stamina, $strenght, $agility);

            $callable->setupCharacter($name, $hp, $exp, $stats);
            $player = $callable->getCharacter();

            $this->session->set('currentCharacter', $player);
            $this->session->set('charSetup', null);

            return $this->redirectToRoute('rpg_turn');
        }
        return $this->redirectToRoute('rpg_new');
    }

    /**
     * @Route("/rpg/turn", name="rpg_turn_post", methods={"POST"})
    */
    public function rpgTurnPost(): Response
    {
        $callable = $this->session->get('currentGame');
        $character = $this->session->get('currentCharacter');
        $characterHP = $character->getMaxHp();

        $allMonsters = $this->session->get('allMonsters');

        $monsterNumber = rand(0, count($allMonsters) - 1);

        $currentMonster = $allMonsters[$monsterNumber];



        $dices = $callable ->generateDices($currentMonster["dices"]);
        $hp = round($currentMonster["hpPercentage"] * $characterHP);
        $monster = new Monster(
            $currentMonster["name"],
            $hp,
            $currentMonster["exp"],
            $dices
        );

        $this->session->set("currentMonster", $monster);

        return $this->redirectToRoute('rpg_battle');
    }

    /**
     * @Route("/rpg/attack", name="rpg_attack_post", methods={"POST"})
    */
    public function rpgAttackPost(): Response
    {
        $game = $this->session->get('currentGame');
        $character = $this->session->get('currentCharacter');
        $monster = $this->session->get('currentMonster');

        $character->roll();
        $monster->roll();

        $lastRollCharacter = $character->getLastRoll();
        $lastRollMonster = $monster->getLastRoll();

        $lastRollCharacter = $game->handleRoll($lastRollCharacter);
        $lastRollMonster = $game->handleRoll($lastRollMonster);


        $damage = $game->countDamage($lastRollCharacter, $lastRollMonster);

        $res = $game->endAttack($character, $monster, $damage);


        $this->session->set('currentCharacter', $res['character']);
        $this->session->set('currentMonster', $res['monster']);
        $this->session->set('toDB', $res['toDB']);

        return $this->redirectToRoute('save_log');
    }

    /**
     * @Route("/rpg/food", name="rpg_food_post", methods={"POST"})
    */
    public function rpgEatFood(): Response
    {
        $character = $this->session->get('currentCharacter');

        $food = $_POST["food"];
        $character->eatFood($food);

        $redirect = $_POST["redirect"];

        $this->session->set('currentCharacter', $character);

        return $this->redirectToRoute('rpg_backpack', ['returnRoute' => $redirect]);
    }

    /**
     * @Route("/rpg/roll", name="rpg_roll")
    */
    public function rpgroll(): Response
    {
        $dice = new Dice(6, 'health3');
        $roll = $dice->roll();

        return $this->render('base.html.twig', [
            'header' => "Welcome!",
            'message' => 'Value: ' . strval($roll["value"]) . "Special: " . $roll["special"]
        ]);
    }
}
