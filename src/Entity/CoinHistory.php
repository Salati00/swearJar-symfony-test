<?php

namespace App\Entity;

use App\Repository\CoinHistoryRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CoinHistoryRepository::class)
 */
class CoinHistory
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="datetime")
     */
    private $timeSignature;

    /**
     * @ORM\Column(type="integer")
     */
    private $increase;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTimeSignature(): ?\DateTimeInterface
    {
        return $this->timeSignature;
    }

    public function setTimeSignature(\DateTimeInterface $timeSignature): self
    {
        $this->timeSignature = $timeSignature;

        return $this;
    }

    public function getIncrease(): ?int
    {
        return $this->increase;
    }

    public function setIncrease(int $increase): self
    {
        $this->increase = $increase;

        return $this;
    }
}
