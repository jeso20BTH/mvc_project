<?php

namespace App\Entity;

use App\Repository\MvcProjectTurnLogRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=MvcProjectTurnLogRepository::class)
 */
class MvcProjectTurnLog
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
    private $player_name;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $monster_name;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $player_damage;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $monster_damage;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $player_health_gain;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $monster_health_gain;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $gameNumber;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPlayerName(): ?string
    {
        return $this->player_name;
    }

    public function setPlayerName(?string $player_name): self
    {
        $this->player_name = $player_name;

        return $this;
    }

    public function getMonsterName(): ?string
    {
        return $this->monster_name;
    }

    public function setMonsterName(?string $monster_name): self
    {
        $this->monster_name = $monster_name;

        return $this;
    }

    public function getPlayerDamage(): ?int
    {
        return $this->player_damage;
    }

    public function setPlayerDamage(?int $player_damage): self
    {
        $this->player_damage = $player_damage;

        return $this;
    }

    public function getMonsterDamage(): ?int
    {
        return $this->monster_damage;
    }

    public function setMonsterDamage(?int $monster_damage): self
    {
        $this->monster_damage = $monster_damage;

        return $this;
    }

    public function getPlayerHealthGain(): ?int
    {
        return $this->player_health_gain;
    }

    public function setPlayerHealthGain(?int $player_health_gain): self
    {
        $this->player_health_gain = $player_health_gain;

        return $this;
    }

    public function getMonsterHealthGain(): ?int
    {
        return $this->monster_health_gain;
    }

    public function setMonsterHealthGain(?int $monster_health_gain): self
    {
        $this->monster_health_gain = $monster_health_gain;

        return $this;
    }

    public function getGameNumber(): ?int
    {
        return $this->gameNumber;
    }

    public function setGameNumber(?int $gameNumber): self
    {
        $this->gameNumber = $gameNumber;

        return $this;
    }
}
