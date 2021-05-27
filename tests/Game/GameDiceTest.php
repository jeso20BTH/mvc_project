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

    /**
     * Check that the last roll is greater than 0 and smaller than 7 after rolling.
     */
    public function testDiceLastRollWithRoll()
    {
        $controller = new Dice(6, 'normal');
        $this->assertInstanceOf("\App\Game\Dice", $controller);

        $lastRoll = $controller->getLastRoll();

        $this->assertEmpty($lastRoll);

        $lastRoll = $controller->roll();

        $this->assertTrue($lastRoll['value'] >= 1);
        $this->assertTrue($lastRoll['value'] <= 6);
        $this->assertTrue($lastRoll['special'] == null);
    }

    /**
     * Check that the last roll is greater than 0 and smaller than 7 after rolling.
     */
    public function testDiceSetRoll()
    {
        $controller = new Dice(6, 'normal');
        $this->assertInstanceOf("\App\Game\Dice", $controller);

        $exp = ['value' => 6, 'special' => null];
        $lastRoll = $controller->setLastRoll($exp);
        $lastRoll = $controller->getLastRoll();

        $this->assertEquals($lastRoll, $exp);
    }

    /**
     * Check that the last roll is greater than 0 and smaller than 7 after rolling.
     */
    public function testDicePresentDices()
    {
        $controller = new Dice(20, 'damage3');
        $this->assertInstanceOf("\App\Game\Dice", $controller);

        $exp = ['type' => 'damage3', 'faces' => 20];
        $res = $controller->presentDice();

        $this->assertEquals($res, $exp);
    }
}
