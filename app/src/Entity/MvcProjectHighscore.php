<?php

namespace App\Entity;

use App\Repository\MvcProjectHighscoreRepository;
use Doctrine\ORM\Mapping as ORM;

/**
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

    public function getKills(): ?int
    {
        return $this->kills;
    }

    public function setKills(?int $kills): self
    {
        $this->kills = $kills;

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
