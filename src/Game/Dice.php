<?php

declare(strict_types=1);

namespace App\Game;


/**
 * Class Dice.
 */
class Dice
{
    private int $faces;
    private array $specialFaces;
    private ?array $roll = null;
    const DICES = [
        "normal" => [],
        "health1" => [1 => 'h'],
        "health2" => [1 => 'h', 2 => 'h'],
        "health3" => [1 => 'h', 2 => 'h', 3 => 'h'],
        "shield1" => [1 => 's'],
        "shield2" => [1 => 's', 2 => 's'],
        "shield3" => [1 => 's', 2 => 's', 3 => 's'],
        "damage1" => [1 => 'd'],
        "damage2" => [1 => 'd', 2 => 'd'],
        "damage3" => [1 => 'd', 2 => 'd', 3 => 'd']
    ];

    public function __construct(int $faces, string $type)
    {
        $this->faces = $faces;
        $this->specialFaces = Dice::DICES[$type];
    }

    public function roll(): array
    {
        $this->roll["value"] = rand(1, $this->faces);
        $this->roll["special"] = $this->specialFaces[$this->roll["value"]] ?? null;


        return $this->roll;
    }

    public function getLastRoll(): ?array
    {
        return $this->roll;
    }

    public function setLastRoll(array $roll): void
    {
        $this->roll = $roll;
    }
}
