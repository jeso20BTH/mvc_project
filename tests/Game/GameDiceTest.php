<?php

declare(strict_types=1);

namespace App\Game;

use PHPUnit\Framework\TestCase;
use Psr\Http\Message\ResponseInterface;

/**
 * Test cases for the controller Debug.
 */
class GameDiceTest extends TestCase
{
    /**
     * Try to create the dice class.
     */
    public function testCreateTheDiceClass()
    {
        $controller = new Dice(6, 'normal');
        $this->assertInstanceOf("\App\Game\Dice", $controller);
    }

    /**
     * Check that the last roll is null before rolling.
     */
    public function testDiceLastRollNoRoll()
    {
        $controller = new Dice(6, 'normal');
        $this->assertInstanceOf("\App\Game\Dice", $controller);

        $lastRoll = $controller->getLastRoll();

        $this->assertEmpty($lastRoll);
    }
}
