<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ReviewRepository")
 */
class Review
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;
/**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $rate;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $rateNick;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $rateSumm;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $rateRev;

    /**
     * @ORM\Column(type="integer")
     * @ORM\ManyToOne(targetEntity="Book")
     * @ORM\JoinColumn(name="book", referencedColumnName="id")
     */
    private $book;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getRate(): ?int
    {
        return $this->rate;
    }

    public function setRate(?int $rate): self
    {
        $this->rate = $rate;

        return $this;
    }

    public function getRateNick(): ?string
    {
        return $this->rateNick;
    }

    public function setRateNick(?string $rateNick): self
    {
        $this->rateNick = $rateNick;

        return $this;
    }

    public function getRateSumm(): ?string
    {
        return $this->rateSumm;
    }

    public function setRateSumm(?string $rateSumm): self
    {
        $this->rateSumm = $rateSumm;

        return $this;
    }

    public function getRateRev(): ?string
    {
        return $this->rateRev;
    }

    public function setRateRev(?string $rateRev): self
    {
        $this->rateRev = $rateRev;

        return $this;
    }
    public function getBook(): ?int
    {
        return $this->book;
    }

    public function setBook(int $Book): self
    {
        $this->book = $Book;

        return $this;
    }
}
