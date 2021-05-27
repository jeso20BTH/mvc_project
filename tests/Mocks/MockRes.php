<?php

declare(strict_types=1);

namespace App\Mocks;

/**
 * Class Dice.
 */
class MockRes
{
    private string $type;
    private int $value;
    private string $name;

    public function __construct(string $type, int $value, string $name)
    {
        $this->type = $type;
        $this->value = $value;
        $this->name = $name;
    }

    public function getType(): string
    {
        return $this->type;
    }

    public function getValue(): int
    {
        return $this->value;
    }

    public function getName(): string
    {
        return $this->name;
    }
}
