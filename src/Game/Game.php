<?php

declare(strict_types=1);

namespace App\Game;

/**
 * Class Dice.
 */
class Game
{
    private int $gameNumber;
    private Character $player;
    const POINTS_TO_START = 5;


    public function __construct(int $gameNumber)
    {
        $this->gameNumber = $gameNumber;
    }

    public function generateStats($stamina, $strenght, $agility): array
    {
        return [
            'stamina' => $stamina,
            'strenght' => $strenght,
            'agility' => $agility
        ];
    }

    public function generateDices($faces, $dices): array
    {
        $dicesToUse = [];

        for ($i=0; $i < $dices; $i++) {
            $dicesToUse[] = new Dice($faces, 'normal');
        }
        return $dicesToUse;
    }

    public function setupCharacter(
        string $name,
        int $hp,
        int $exp,
        ?array $stats,
        ?array $backpack = null,
        ?array $normalDices = null
        ): void
    {
        if ($backpack === null) {
            $backpack = GameRules::LEVEL_REWARD["start"];
        }

        $this->player = new Character($name, $hp, $exp);

        $this->player->setStats($stats);

        foreach ($backpack as $item) {
            $this->player->addToBackpack($item);
        }

        $len = GameRules::BASE_DICES + ($stats["agility"] * GameRules::INCREASE_DICES);
        $faces = GameRules::BASE_DICE_SIDES + ($stats["strenght"] * GameRules::INCREASE_DICE_SIDES);
        for ($i=0; $i < $len; $i++) {
            $this->player->addDice($faces, 'normal');
        }
    }

    public function getCharacter(): Character
    {
        return $this->player;
    }

    public function handleRoll(array $roll): ?array
    {
        $res = [
            'sum' => 0,
            'health' => 0,
            'shield' => 0,
            'damage' => 0,
            'rolls' => []
        ];

        foreach ($roll as $dice) {
            switch ($dice["special"]) {
                case 's':
                    $res["shield"]++;
                    break;
                case 'h':
                    $res["health"]++;
                    break;
                case 'd':
                    $res["damage"]++;
                    break;
                default:
                    $res['sum'] += $dice["value"];
                    $res['rolls'][] = $dice["value"];
                    break;
            }
        }

        sort($res["rolls"]);

        return $res;
    }

    public function countDamage(array $playerRoll, array $monsterRoll): array
    {
        $playerDamage = $playerRoll["sum"] * (1 + ($playerRoll["damage"] * GameRules::EXTRA_DAMAGE));
        $playerDefence = $playerRoll["shield"] * GameRules::DAMAGE_BLOCKED;
        $playerHealth = $playerRoll["health"] * GameRules::HEALTH_GAIN;

        $monsterDamage = $monsterRoll["sum"] * (1 + $monsterRoll["damage"] * GameRules::EXTRA_DAMAGE);
        $monsterDefence = $monsterRoll["shield"] * GameRules::DAMAGE_BLOCKED;
        $monsterHealth = $monsterRoll["health"] * GameRules::HEALTH_GAIN;

        $playerDamage -= $monsterDefence;
        $monsterDamage -= $playerDefence;

        $playerDamage = ($playerDamage >= 0) ? round($playerDamage) : 0;
        $monsterDamage = ($monsterDamage >= 0) ? round($monsterDamage) : 0;

        return [
            'player' => [
                'damageTaken' => intVal($monsterDamage),
                'healthGain' => $playerHealth
            ],
            'monster' => [
                'damageTaken' => intval($playerDamage),
                'healthGain' => $monsterHealth
            ]
        ];
    }

    public function endAttack(Character $character, Monster $monster, array $damage): array
    {
        $character->dealDamage($damage['player']['damageTaken']);
        $monster->dealDamage($damage['monster']['damageTaken']);

        $character->heal($damage['player']['healthGain']);
        $monster->heal($damage['monster']['healthGain']);

        return [
            'character' => $character,
            'monster' => $monster,
            'toDB' => [
                [
                    'time' => date("Y-m-d H:i:s"),
                    'name' => $character->getName(),
                    'monsterName' => $monster->getName(),
                    'gameNumber' => $this->gameNumber,
                    'type' => 'attack',
                    'value' => $damage['monster']['damageTaken'],
                ],
                [
                    'time' => date("Y-m-d H:i:s"),
                    'name' => $character->getName(),
                    'monsterName' => $monster->getName(),
                    'gameNumber' => $this->gameNumber,
                    'type' => 'attack enemy',
                    'value' => $damage['player']['damageTaken'],
                ],
                [
                    'time' => date("Y-m-d H:i:s"),
                    'name' => $character->getName(),
                    'monsterName' => $monster->getName(),
                    'gameNumber' => $this->gameNumber,
                    'type' => 'heal',
                    'value' => $damage['player']['healthGain'],
                ],
                [
                    'time' => date("Y-m-d H:i:s"),
                    'name' => $character->getName(),
                    'monsterName' => $monster->getName(),
                    'gameNumber' => $this->gameNumber,
                    'type' => 'heal enemy',
                    'value' => $damage['monster']['healthGain'],
                ]
            ]
        ];
    }

    public function summaryMonster(array $monster, string $charName): array
    {
        return [
                [
                'time' => date("Y-m-d H:i:s"),
                'name' => $charName,
                'monsterName' => $monster["name"],
                'gameNumber' => $this->gameNumber,
                'type' => 'kill',
                'value' => $monster['exp']
            ]
        ];
    }

    public function getGame(): int
    {
        return $this->gameNumber;
    }

    public function characterDeath(array $character, string $monsterName): array
    {
        return [
            'time' => date("Y-m-d H:i:s"), // Add correct format
            'name' => $character['name'],
            'monsterName' => $monsterName,
            'gameNumber' => $this->gameNumber,
            'type' => 'death',
            'value' => 666
        ];
    }

    public function gameSummary($res): array
    {
        $killCounter = 0;
        $healCounter = 0;
        $damageDealtCounter = 0;
        $damageTakenCounter = 0;
        $expCounter = 0;
        foreach ($res as $row) {
            switch ($row->getType()) {
                case 'kill':
                    $killCounter++;
                    $expCounter += $row->getValue();
                    break;
                case 'heal':
                    $healCounter += $row->getValue();
                    break;
                case 'attack':
                    $damageDealtCounter += $row->getValue();
                    break;
                case 'attack enemy':
                    $damageTakenCounter += $row->getValue();
                    break;
            }
        }

        $score = $killCounter * GameRules::KILL_VALUE + $healCounter + $damageDealtCounter + $expCounter - $damageTakenCounter;

        return [
            'gameNumber' => $this->gameNumber,
            'name' => $res[0]->getName(),
            'kills' => $killCounter,
            'exp' => $expCounter,
            'heal' => $healCounter,
            'damageDealt' => $damageDealtCounter,
            'damageTaken' => $damageTakenCounter,
            'score' => $score
        ];

    }
}
