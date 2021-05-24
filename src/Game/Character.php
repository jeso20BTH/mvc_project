<?php

declare(strict_types=1);

namespace App\Game;


/**
 * Class Dice.
 */
class Character
{
    private string $name;
    private int $hp;
    private int $maxHP;
    private int $exp;
    private ?array $backpack;
    private ?array $skills;
    private ?array $stats;
    private ?array $lastRoll;


    public function __construct(
        string $name,
        int $hp,
        int $exp
        )
    {
        $this->name = $name;
        $this->hp = $hp;
        $this->maxHP = $hp;
        $this->exp = $exp;
        $this->backpack = ['dices' => [], 'food' => []];
        $this->stats = [];
    }

    public function roll(): void
    {
        $this->lastRoll = [];

        foreach ($this->backpack["dices"] as $dice) {
            $this->lastRoll[] = $dice->roll();
        }
    }

    public function getLastRoll(): ?array
    {
        return $this->lastRoll;
    }

    private function levelCounter(int $exp): array
    {
        $expNextLevel = GameRules::LEVEL_EXP;
        $level = 1;
        $currentLevelExp = $exp;


        while ($currentLevelExp >= $expNextLevel) {
            $level++;
            $currentLevelExp -= $expNextLevel;

            $expNextLevel *= GameRules::INCREASE_LEVEL;
        }

        return [
                'level' => $level,
                'exp' => $currentLevelExp,
                'maxExp' => $expNextLevel
            ];
    }

    public function presentPlayer(): ?array
    {
        $levelData = $this->levelCounter($this->exp);
        $level = $levelData["level"];
        $expNextLevel = $levelData["maxExp"];
        $currentLevelExp = $levelData["exp"];

        $dices = [];

        foreach ($this->backpack["dices"] as $dice) {
            $res = $dice->presentDice();
            $type = $res["type"];
            $faces = $res["faces"];

            if (array_key_exists($type, $dices) && array_key_exists($faces, $dices[$type])) {
                $dices[$type][$faces]++;
            } else {
                $dices[$type][$faces] = 1;
            }
        }

        return [
            'hp' => $this->hp,
            'maxHP' => $this->maxHP,
            'exp' => $currentLevelExp,
            'maxExp' => $expNextLevel,
            'level' => $level,
            'name' => $this->name,
            'backpack' => [
                'dices' => $dices,
                'food' => $this->backpack["food"]
            ]
        ];
    }

    public function dealDamage(int $damage): void
    {
        $this->hp -= $damage;
    }

    public function heal(int $amount): void
    {
        $this->hp += $amount;
    }

    public function getName(): String
    {
        return $this->name;
    }

    public function addExp(int $exp): void
    {
        $this->exp += $exp;
    }

    public function eatFood(string $food): void
    {
        $this->hp += GameRules::FOOD[$food];

        if ($this->hp > $this->maxHP) {
            $this->hp = $this->maxHP;
        }

        $this->backpack["food"][$food]--;

        if ($this->backpack["food"][$food] <= 0) {
            unset($this->backpack["food"][$food]);
        }
    }

    public function levelUp(int $monsterExp): bool
    {
        $lvlBefore = $this->levelCounter($this->exp - $monsterExp)["level"];
        $lvlNow = $this->levelCounter($this->exp)["level"];

        if ($lvlNow > $lvlBefore) {
            $rewards = GameRules::LEVEL_REWARD[$lvlNow];

            foreach ($rewards as $reward) {
                $this->addToBackpack($reward);
            }

            return true;
        }

        return false;
    }

    public function addFood(string $food): void
    {
        if (array_key_exists($food, $this->backpack['food'])) {
            $this->backpack['food'][$food]++;

            return;
        }

        $this->backpack['food'][$food] = 1;
    }

    public function addDice(int $faces, string $dice): void
    {
        $this->backpack['dices'][] = new Dice($faces, $dice);
    }



    public function addToBackpack(string $toAdd): void
    {
        if (array_key_exists($toAdd, GameRules::FOOD)) {
            $this->addFood($toAdd);
        } elseif (array_key_exists($toAdd, Dice::DICES)) {
            $diceFaces =  GameRules::BASE_DICE_SIDES + ($this->stats["strenght"] * GameRules::INCREASE_DICE_SIDES);
            $this->addDice($diceFaces, $toAdd);
        }
    }

    public function setStats(array $stats): void
    {
        $this->stats = $stats;
    }

    public function getStats(): array
    {
        return $this->stats;
    }
}
