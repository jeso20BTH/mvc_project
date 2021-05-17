<?php

namespace App\Entity;

use App\Repository\MvcProjectMonsterLogRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=MvcProjectMonsterLogRepository::class)
 */
class MvcProjectMonsterLog
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $name;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $hp;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $exp;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $dices;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $game_number;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getHp(): ?int
    {
        return $this->hp;
    }

    public function setHp(?int $hp): self
    {
        $this->hp = $hp;

        return $this;
    }

    public function getExp(): ?int
    {
        return $this->exp;
    }

    public function setExp(?int $exp): self
    {
        $this->exp = $exp;

        return $this;
    }

    public function getDices(): ?int
    {
        return $this->dices;
    }

    public function setDices(?int $dices): self
    {
        $this->dices = $dices;

        return $this;
    }

    public function getGameNumber(): ?int
    {
        return $this->game_number;
    }

    public function setGameNumber(?int $game_number): self
    {
        $this->game_number = $game_number;

        return $this;
    }
}
