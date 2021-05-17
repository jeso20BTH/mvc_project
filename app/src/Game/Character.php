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
        int $exp,
        ?array $dices,
        ?array $food,
        ?array $skills,
        ?array $stats
        )
    {
        $this->name = $name;
        $this->hp = $hp;
        $this->maxHP = $hp;
        $this->exp = $exp;
        $this->backpack = [
            'dices' => $dices,
            'food' => $food
        ];
        $this->skills = $skills;
        $this->stats = $stats;
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

    public function presentPlayer(): ?array
    {
        $expNextLevel = GameRules::LEVEL_EXP;
        $level = 1;
        $currentLevelExp = $this->exp;


        while ($currentLevelExp >= $expNextLevel) {
            $level++;
            $currentLevelExp -= $expNextLevel;

            $expNextLevel *= GameRules::INCREASE_LEVEL;
        }

        return [
            'hp' => $this->hp,
            'maxHP' => $this->maxHP,
            'exp' => $this->exp,
            'maxExp' => $expNextLevel,
            'level' => $level,
            'name' => $this->name
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
}
