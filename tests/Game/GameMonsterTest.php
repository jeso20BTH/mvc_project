<?php

declare(strict_types=1);

namespace App\Game;

use PHPUnit\Framework\TestCase;
use Psr\Http\Message\ResponseInterface;

/**
 * Test cases for the controller Debug.
 */
class GameMonsterTest extends TestCase
{
    /**
     * Try to create the dice class.
     */
    public function testCreateTheMonsterClass()
    {
        $dices = [new Dice(6, 'normal')];
        $controller = new Monster('Test',100, 10, $dices);
        $this->assertInstanceOf("\App\Game\Monster", $controller);

        $exp = [
            'hp' => 100,
            'maxHP' => 100,
            'exp' => 10,
            'name' => 'Test',
            'dices' => 1
        ];

        $res = $controller->presentMonster();

        $this->assertEquals($res, $exp);
    }

    /**
     * Try to create the dice class.
     */
    public function testDealDamage()
    {
        $dices = [new Dice(6, 'normal')];
        $controller = new Monster('Test',100, 10, $dices);
        $this->assertInstanceOf("\App\Game\Monster", $controller);

        $controller->dealDamage(10);

        $exp = [
            'hp' => 90,
            'maxHP' => 100,
            'exp' => 10,
            'name' => 'Test',
            'dices' => 1
        ];

        $res = $controller->presentMonster();

        $this->assertEquals($res, $exp);
    }

    /**
     * Try to create the dice class.
     */
    public function testHeal()
    {
        $dices = [new Dice(6, 'normal')];
        $controller = new Monster('Test',100, 10, $dices);
        $this->assertInstanceOf("\App\Game\Monster", $controller);

        $controller->dealDamage(15);
        $controller->heal(10);

        $exp = [
            'hp' => 95,
            'maxHP' => 100,
            'exp' => 10,
            'name' => 'Test',
            'dices' => 1
        ];

        $res = $controller->presentMonster();

        $this->assertEquals($res, $exp);
    }

    /**
     * Try to create the dice class.
     */
    public function testGetName()
    {
        $dices = [new Dice(6, 'normal')];
        $controller = new Monster('Test',100, 10, $dices);
        $this->assertInstanceOf("\App\Game\Monster", $controller);

        $exp = 'Test';

        $res = $controller->getName();

        $this->assertEquals($res, $exp);
    }

    /**
     * Try to create the dice class.
     */
    public function testRoll()
    {
        $dices = [new Dice(6, 'normal')];
        $controller = new Monster('Test',100, 10, $dices);
        $this->assertInstanceOf("\App\Game\Monster", $controller);

        $lastRoll = $controller->getLastRoll();
        $this->assertEmpty($lastRoll);

        $controller->roll();
        $lastRoll = $controller->getLastRoll();

        $this->assertTrue($lastRoll[0]['value'] >= 1);
        $this->assertTrue($lastRoll[0]['value'] <= 6);
        $this->assertEmpty($lastRoll[0]['special']);
    }

    // /**
    //  * Try to create the dice class.
    //  */
    // public function testCreateTheCharacterClassWithExp()
    // {
    //     $controller = new Character('Test',100, 10);
    //     $this->assertInstanceOf("\App\Game\Character", $controller);
    //
    //     $exp = [
    //         'hp' => 100,
    //         'maxHP' => 100,
    //         'exp' => 0,
    //         'maxExp' => 20,
    //         'level'=> 2,
    //         'name' => 'Test',
    //         'backpack' => [
    //             'dices' => [],
    //             'food' => []
    //         ]
    //     ];
    //
    //     $res = $controller->presentPlayer();
    //
    //     $this->assertEquals($res, $exp);
    // }
    //
    // /**
    //  * Try to create the dice class.
    //  */
    // public function testAddDice()
    // {
    //     $controller = new Character('Test',100, 10);
    //     $this->assertInstanceOf("\App\Game\Character", $controller);
    //
    //     $controller->addDice(7, 'normal');
    //
    //     $exp = [
    //         'hp' => 100,
    //         'maxHP' => 100,
    //         'exp' => 0,
    //         'maxExp' => 20,
    //         'level'=> 2,
    //         'name' => 'Test',
    //         'backpack' => [
    //             'dices' => ['normal' => [7 => 1]],
    //             'food' => []
    //         ]
    //     ];
    //
    //     $res = $controller->presentPlayer();
    //
    //     $this->assertEquals($res, $exp);
    // }
    //
    // /**
    //  * Try to create the dice class.
    //  */
    // public function testAddMultipleEqualDices()
    // {
    //     $controller = new Character('Test',100, 10);
    //     $this->assertInstanceOf("\App\Game\Character", $controller);
    //
    //     $controller->addDice(7, 'normal');
    //     $controller->addDice(7, 'normal');
    //
    //     $exp = [
    //         'hp' => 100,
    //         'maxHP' => 100,
    //         'exp' => 0,
    //         'maxExp' => 20,
    //         'level'=> 2,
    //         'name' => 'Test',
    //         'backpack' => [
    //             'dices' => ['normal' => [7 => 2]],
    //             'food' => []
    //         ]
    //     ];
    //
    //     $res = $controller->presentPlayer();
    //
    //     $this->assertEquals($res, $exp);
    // }
    //

    //

    //
    // /**
    //  * Try to create the dice class.
    //  */
    // public function testGetName()
    // {
    //     $controller = new Character('Test',100, 10);
    //     $this->assertInstanceOf("\App\Game\Character", $controller);
    //
    //     $exp = 'Test';
    //
    //     $res = $controller->getName();
    //
    //     $this->assertEquals($res, $exp);
    // }
    //
    // /**
    //  * Try to create the dice class.
    //  */
    // public function testGetMaxHp()
    // {
    //     $controller = new Character('Test',100, 10);
    //     $this->assertInstanceOf("\App\Game\Character", $controller);
    //
    //     $exp = 100;
    //
    //     $res = $controller->getMaxHp();
    //
    //     $this->assertEquals($res, $exp);
    // }
    //
    // /**
    //  * Try to create the dice class.
    //  */
    // public function testAddExp()
    // {
    //     $controller = new Character('Test',100, 0);
    //     $this->assertInstanceOf("\App\Game\Character", $controller);
    //
    //     $controller->addExp(10);
    //
    //     $exp = [
    //         'hp' => 100,
    //         'maxHP' => 100,
    //         'exp' => 0,
    //         'maxExp' => 20,
    //         'level'=> 2,
    //         'name' => 'Test',
    //         'backpack' => [
    //             'dices' => [],
    //             'food' => []
    //         ]
    //     ];
    //
    //     $res = $controller->presentPlayer();
    //
    //     $this->assertEquals($res, $exp);
    // }
    //
    // /**
    //  * Try to create the dice class.
    //  */
    // public function testEatFoodMultipleInBackpack()
    // {
    //     $controller = new Character('Test',100, 0);
    //     $this->assertInstanceOf("\App\Game\Character", $controller);
    //
    //     $controller->addFood('cookie');
    //     $controller->addFood('cookie');
    //
    //     $exp = [
    //         'hp' => 100,
    //         'maxHP' => 100,
    //         'exp' => 0,
    //         'maxExp' => 10,
    //         'level'=> 1,
    //         'name' => 'Test',
    //         'backpack' => [
    //             'dices' => [],
    //             'food' => ['cookie'=>2]
    //         ]
    //     ];
    //
    //     $res = $controller->presentPlayer();
    //     $this->assertEquals($res, $exp);
    //
    //     $controller->eatFood('cookie');
    //
    //     $exp = [
    //         'hp' => 100,
    //         'maxHP' => 100,
    //         'exp' => 0,
    //         'maxExp' => 10,
    //         'level'=> 1,
    //         'name' => 'Test',
    //         'backpack' => [
    //             'dices' => [],
    //             'food' => ['cookie'=>1]
    //         ]
    //     ];
    // }
    //
    // /**
    //  * Try to create the dice class.
    //  */
    // public function testEatFoodLastOneInBackpack()
    // {
    //     $controller = new Character('Test',100, 0);
    //     $this->assertInstanceOf("\App\Game\Character", $controller);
    //
    //     $controller->addFood('cookie');
    //
    //     $exp = [
    //         'hp' => 100,
    //         'maxHP' => 100,
    //         'exp' => 0,
    //         'maxExp' => 10,
    //         'level'=> 1,
    //         'name' => 'Test',
    //         'backpack' => [
    //             'dices' => [],
    //             'food' => ['cookie'=>1]
    //         ]
    //     ];
    //
    //     $res = $controller->presentPlayer();
    //     $this->assertEquals($res, $exp);
    //
    //     $controller->eatFood('cookie');
    //
    //     $exp = [
    //         'hp' => 100,
    //         'maxHP' => 100,
    //         'exp' => 0,
    //         'maxExp' => 10,
    //         'level'=> 1,
    //         'name' => 'Test',
    //         'backpack' => [
    //             'dices' => [],
    //             'food' => []
    //         ]
    //     ];
    // }
    //
    // /**
    //  * Try to create the dice class.
    //  */
    // public function testLevelUp()
    // {
    //     $controller = new Character('Test',100, 0);
    //     $this->assertInstanceOf("\App\Game\Character", $controller);
    //
    //     $controller->addExp(10);
    //
    //     $exp = [
    //         'hp' => 100,
    //         'maxHP' => 100,
    //         'exp' => 0,
    //         'maxExp' => 20,
    //         'level'=> 2,
    //         'name' => 'Test',
    //         'backpack' => [
    //             'dices' => [],
    //             'food' => []
    //         ]
    //     ];
    //
    //     $res = $controller->presentPlayer();
    //     $this->assertEquals($res, $exp);
    //
    //     $status = $controller->levelUp(10);
    //
    //     $exp = [
    //         'hp' => 100,
    //         'maxHP' => 100,
    //         'exp' => 0,
    //         'maxExp' => 20,
    //         'level'=> 2,
    //         'name' => 'Test',
    //         'backpack' => [
    //             'dices' => ['shield1' => [6 => 1]],
    //             'food' => ['apple' => 1]
    //         ]
    //     ];
    //     $res = $controller->presentPlayer();
    //     $this->assertEquals($res, $exp);
    //     $this->assertTrue($status);
    // }
    //
    // /**
    //  * Try to create the dice class.
    //  */
    // public function testNotLevelUp()
    // {
    //     $controller = new Character('Test',100, 0);
    //     $this->assertInstanceOf("\App\Game\Character", $controller);
    //
    //     $controller->addExp(8);
    //
    //     $exp = [
    //         'hp' => 100,
    //         'maxHP' => 100,
    //         'exp' => 8,
    //         'maxExp' => 10,
    //         'level'=> 1,
    //         'name' => 'Test',
    //         'backpack' => [
    //             'dices' => [],
    //             'food' => []
    //         ]
    //     ];
    //
    //     $res = $controller->presentPlayer();
    //     $this->assertEquals($res, $exp);
    //
    //     $status = $controller->levelUp(10);
    //
    //     $exp = [
    //         'hp' => 100,
    //         'maxHP' => 100,
    //         'exp' => 8,
    //         'maxExp' => 10,
    //         'level'=> 1,
    //         'name' => 'Test',
    //         'backpack' => [
    //             'dices' => [],
    //             'food' => []
    //         ]
    //     ];
    //     $res = $controller->presentPlayer();
    //     $this->assertEquals($res, $exp);
    //     $this->assertFalse($status);
    // }
    //
    // /**
    //  * Try to create the dice class.
    //  */
    // public function testSetStats()
    // {
    //     $controller = new Character('Test',100, 0);
    //     $this->assertInstanceOf("\App\Game\Character", $controller);
    //
    //     $exp = [];
    //     $res = $controller->getStats();
    //     $this->assertEquals($res, $exp);
    //
    //     $exp = [
    //         'strenght' => 2,
    //         'stamina' => 4,
    //         'agility' => 1
    //     ];
    //     $res = $controller->setStats($exp);
    //     $res = $controller->getStats();
    //     $this->assertEquals($res, $exp);
    // }
    //
    // /**
    //  * Try to create the dice class.
    //  */
    // public function testRoll()
    // {
    //     $controller = new Character('Test',100, 0);
    //     $this->assertInstanceOf("\App\Game\Character", $controller);
    //
    //     $controller->addDice(7, 'normal');
    //
    //     $lastRoll = $controller->getLastRoll();
    //     $this->assertEmpty($lastRoll);
    //
    //     $controller->roll();
    //     $lastRoll = $controller->getLastRoll();
    //
    //     $this->assertTrue($lastRoll[0]['value'] >= 1);
    //     $this->assertTrue($lastRoll[0]['value'] <= 7);
    //     $this->assertEmpty($lastRoll[0]['special']);
    // }
}
