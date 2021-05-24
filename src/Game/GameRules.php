<?php

declare(strict_types=1);

namespace App\Game;


/**
 * Class Dice.
 */
class GameRules
{
    const POINTS_TO_START = 5;
    const LEVEL_UP_POINTS = 1;
    const HP_INCREASAE = 5;
    const BASE_HP = 100;
    const BASE_DICE_SIDES = 6;
    const BASE_DICES = 2;
    const INCREASE_HP = 5;
    const INCREASE_DICE_SIDES = 1;
    const INCREASE_DICES = 1;
    const INCREASE_LEVEL = 2;
    const LEVEL_EXP = 10;
    const HEALTH_GAIN = 5;
    const DAMAGE_BLOCKED = 5;
    const EXTRA_DAMAGE = 0.2;
    CONST FOOD = [
        'cookie' => 5,
        'egg' => 10,
        'apple' => 10,
        'bread' => 15,
        'beer' => 20,
        'soup' => 25,
        'cheese' => 30,
        'steak' => 50
    ];
    CONST LEVEL_REWARD = [
        "start" => ['cookie', 'cookie', 'cookie', 'health1'],
        2 => ['apple', 'shield1'],
        3 => ['egg', 'egg', 'health1'],
        4 => ['bread', 'bread', 'damage1'],
        5 => ['beer', 'bread', 'shield2'],
        6 => ['soup', 'health2'],
        7 => ['cheese', 'cheese', 'damage2'],
        8 => ['steak', 'steak', 'steak'],
        9 => ['steak', 'steak', 'steak'],
        10 => ['shield3', 'health3', 'damage3']
    ];
    CONST SKILL_POINTS_LEVEL_UP = 2;
}
