<?php

namespace App\Entity;

use App\Repository\MvcProjectMonsterDiceRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @codeCoverageIgnore
 * @ORM\Entity(repositoryClass=MvcProjectMonsterDiceRepository::class)
 */
class MvcProjectMonsterDice
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $monsterId;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $dice;

    /**
     * @ORM\Column(type="integer")
     */
    private $faces;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMonsterId(): ?int
    {
        return $this->monsterId;
    }

    public function setMonsterId(int $monsterId): self
    {
        $this->monsterId = $monsterId;

        return $this;
    }

    public function getDice(): ?string
    {
        return $this->dice;
    }

    public function setDice(string $dice): self
    {
        $this->dice = $dice;

        return $this;
    }

    public function getFaces(): ?int
    {
        return $this->faces;
    }

    public function setFaces(int $faces): self
    {
        $this->faces = $faces;

        return $this;
    }
}
