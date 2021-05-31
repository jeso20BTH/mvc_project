<?php

namespace App\Entity;

use App\Repository\MvcProjectHighscoreRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @codeCoverageIgnore
 * @ORM\Entity(repositoryClass=MvcProjectHighscoreRepository::class)
 */
class MvcProjectHighscore
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $game_number;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $name;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $kills;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $exp;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $heal;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $damage_dealt;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $damage_taken;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $score;

    public function getId(): ?int
    {
        return $this->id;
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

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getKills(): ?int
    {
        return $this->kills;
    }

    public function setKills(?int $kills): self
    {
        $this->kills = $kills;

        return $this;
    }

    public function getHeal(): ?int
    {
        return $this->heal;
    }

    public function setHeal(?int $heal): self
    {
        $this->heal = $heal;

        return $this;
    }

    public function getDamageDealt(): ?int
    {
        return $this->damage_dealt;
    }

    public function setDamageDealt(?int $damage_dealt): self
    {
        $this->damage_dealt = $damage_dealt;

        return $this;
    }

    public function getDamageTaken(): ?int
    {
        return $this->damage_taken;
    }

    public function setDamageTaken(?int $damage_taken): self
    {
        $this->damage_taken = $damage_taken;

        return $this;
    }

    public function getScore(): ?int
    {
        return $this->score;
    }

    public function setScore(?int $score): self
    {
        $this->score = $score;

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


}
