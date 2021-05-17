<?php

declare(strict_types=1);

namespace App\Game;


/**
 * Class Dice.
 */
class Monster
{
    private string $name;
    private int $hp;
    private int $maxHP;
    private int $exp;
    private ?array $dices;
    private ?array $lastRoll;


    public function __construct(
        string $name,
        int $hp,
        int $exp,
        ?array $dices
        )
    {
        $this->name = $name;
        $this->hp = $hp;
        $this->maxHP = $hp;
        $this->exp = $exp;
        $this->dices = $dices;
    }

    public function roll(): void
    {
        $this->lastRoll = [];

        foreach ($this->dices as $dice) {
            $this->lastRoll[] = $dice->roll();
        }
    }

    public function getLastRoll(): ?array
    {
        return $this->lastRoll;
    }

    public function presentMonster(): ?array
    {
        return [
            'hp' => $this->hp,
            'maxHP' => $this->maxHP,
            'exp' => $this->exp,
            'name' => $this->name,
            'dices' => count($this->dices)
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
}
