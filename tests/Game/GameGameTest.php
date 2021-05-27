<?php

declare(strict_types=1);

namespace App\Game;

use PHPUnit\Framework\TestCase;
use Psr\Http\Message\ResponseInterface;
use App\Mocks\MockRes;

/**
 * Test cases for the controller Debug.
 */
class GameGameTest extends TestCase
{
    /**
     * Try to create the dice class.
     */
    public function testCreateTheGameClass()
    {
        $controller = new Game(1);
        $this->assertInstanceOf("\App\Game\Game", $controller);

        $exp = 1;
        $res = $controller->getGame();
        $this->assertEquals($res, $exp);
    }

    /**
     * Try to create the dice class.
     */
    public function testGenerateStats()
    {
        $controller = new Game(1);
        $this->assertInstanceOf("\App\Game\Game", $controller);

        $stamina = 5;
        $strenght = 2;
        $agility = 1;
        $exp = [
            'stamina' => $stamina,
            'strenght' => $strenght,
            'agility' => $agility
        ];
        $res = $controller->generateStats($stamina, $strenght, $agility);
        $this->assertEquals($res, $exp);
    }

    /**
     * Try to create the dice class.
     */
    public function testGenerateDices()
    {
        $controller = new Game(1);
        $this->assertInstanceOf("\App\Game\Game", $controller);

        $dices = [['faces' => 6, 'type' => 'normal'], ['faces' => 6, 'type' => 'damage1']];

        $res = $controller->generateDices($dices);
        $this->assertInstanceOf("App\Game\Dice", $res[0]);
        $this->assertInstanceOf("App\Game\Dice", $res[1]);
    }

    /**
     * Try to create the dice class.
     */
    public function testSetupCharacterWithBackpack()
    {
        $controller = new Game(1);
        $this->assertInstanceOf("\App\Game\Game", $controller);

        $res = $controller->getCharacter();
        $this->assertEmpty($res);

        $controller->setupCharacter(
            'Test',
            100,
            0,
            [
                'stamina' => 2,
                'strenght' => 2,
                'agility' => 2
            ],
            ['cookie', 'beer']
        );
        $res = $controller->getCharacter();
        $this->assertInstanceOf("App\Game\Character", $res);
    }

    /**
     * Try to create the dice class.
     */
    public function testSetupCharacterWithNoBackpack()
    {
        $controller = new Game(1);
        $this->assertInstanceOf("\App\Game\Game", $controller);

        $res = $controller->getCharacter();
        $this->assertEmpty($res);

        $controller->setupCharacter(
            'Test',
            100,
            0,
            [
                'stamina' => 2,
                'strenght' => 2,
                'agility' => 2
            ]
        );
        $res = $controller->getCharacter();
        $this->assertInstanceOf("App\Game\Character", $res);
    }

    /**
     * Try to create the dice class.
     */
    public function testHandleRoll()
    {
        $controller = new Game(1);
        $this->assertInstanceOf("\App\Game\Game", $controller);

        $input = [
            ['value' => 1, 'special' => null],
            ['value' => 2, 'special' => 'h'],
            ['value' => 3, 'special' => 's'],
            ['value' => 4, 'special' => 'd']
        ];

        $exp = [
            'sum' => 1,
            'health' => 1,
            'shield' => 1,
            'damage' => 1,
            'rolls' => [1]
        ];
        $res = $controller->handleRoll($input);
        $this->assertEquals($res, $exp);
    }

    /**
     * Try to create the dice class.
     */
    public function testCountDamage()
    {
        $controller = new Game(1);
        $this->assertInstanceOf("\App\Game\Game", $controller);

        $inputPlayer = [
            'sum' => 5,
            'health' => 1,
            'shield' => 1,
            'damage' => 5,
            'rolls' => [5]
        ];

        $inputMonster = [
            'sum' => 5,
            'health' => 1,
            'shield' => 1,
            'damage' => 0,
            'rolls' => [1]
        ];

        $exp = [
            'player' => [
                'damageTaken' => 0,
                'healthGain' => 5
            ],
            'monster' => [
                'damageTaken' => 5,
                'healthGain' => 5
            ]
        ];
        $res = $controller->countDamage($inputPlayer, $inputMonster);
        $this->assertEquals($res, $exp);
    }

    /**
     * Try to create the dice class.
     */
    public function testEndAttack()
    {
        $controller = new Game(1);
        $this->assertInstanceOf("\App\Game\Game", $controller);


        $inputCharacter = new Character('Char', 100, 0);
        $dices = [new Dice(6, 'normal')];
        $inputMonster = new Monster('Test',100, 10, $dices);
        $inputDamage = [
            'player' => [
                'damageTaken' => 0,
                'healthGain' => 5
            ],
            'monster' => [
                'damageTaken' => 5,
                'healthGain' => 5
            ]
        ];
        $res = $controller->endAttack($inputCharacter, $inputMonster, $inputDamage);
        $this->assertInstanceOf("App\Game\Character", $res['character']);
        $this->assertInstanceOf("App\Game\Monster", $res['monster']);

        $exp = 'attack';
        $this->assertEquals($res['toDB'][0]['type'], $exp);

        $exp = 'attack enemy';
        $this->assertEquals($res['toDB'][1]['type'], $exp);

        $exp = 'heal';
        $this->assertEquals($res['toDB'][2]['type'], $exp);

        $exp = 'heal enemy';
        $this->assertEquals($res['toDB'][3]['type'], $exp);
    }

    /**
     * Try to create the dice class.
     */
    public function testSummaryMonster()
    {
        $controller = new Game(1);
        $this->assertInstanceOf("\App\Game\Game", $controller);


        $inputCharacter = 'Char';
        $inputMonster = ['name' => 'Monster', 'exp' => 666];

        $res = $controller->summaryMonster($inputMonster, $inputCharacter);

        $exp = [
                [
                'time' => date("Y-m-d H:i:s"),
                'name' => $inputCharacter,
                'monsterName' => $inputMonster["name"],
                'gameNumber' => 1,
                'type' => 'kill',
                'value' => $inputMonster['exp']
            ]
        ];
        $this->assertEquals($res, $exp);
    }

    /**
     * Try to create the dice class.
     */
    public function testCharacterDeath()
    {
        $controller = new Game(1);
        $this->assertInstanceOf("\App\Game\Game", $controller);


        $inputMonster = 'Monster';
        $inputCharacter = ['name' => 'Character'];

        $res = $controller->characterDeath($inputCharacter, $inputMonster);

        $exp = [
            'time' => date("Y-m-d H:i:s"),
            'name' => $inputCharacter['name'],
            'monsterName' => $inputMonster,
            'gameNumber' => 1,
            'type' => 'death',
            'value' => 666
        ];
        $this->assertEquals($res, $exp);
    }

    /**
     * Try to create the dice class.
     */
    public function testGameSummary()
    {
        $controller = new Game(1);
        $this->assertInstanceOf("\App\Game\Game", $controller);

        $input = [
            new MockRes('kill', 50, 'Test'),
            new MockRes('heal', 50, 'Test'),
            new MockRes('attack', 50, 'Test'),
            new MockRes('attack enemy', 50, 'Test'),
        ];

        $res = $controller->gameSummary($input);

        $exp = [
            'gameNumber' => 1,
            'name' => 'Test',
            'kills' => 1,
            'exp' => 50,
            'heal' => 50,
            'damageDealt' => 50,
            'damageTaken' => 50,
            'score' => 105
        ];
        $this->assertEquals($res, $exp);
    }
}
