<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\GameRepository")
 */
class Game {
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $player;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $winner;

    public function getId() {
        return $this->id;
    }

    public function getPlayer(): ?string {
        return $this->player;
    }

    public function setPlayer(string $player): self {
        $this->player = $player;
        return $this;
    }

    public function getWinner(): ?string {
        return $this->winner;
    }

    public function setWinner(string $winner): self {
        $this->winner = $winner;
        return $this;
    }
}
