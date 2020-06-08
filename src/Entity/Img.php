<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ImgRepository")
 */
class Img
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $donne;

    /**
     * @ORM\Column(type="integer")
     */
    private $book;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDonne(): ?string
    {
        return $this->donne;
    }

    public function setDonne(string $donne): self
    {
        $this->donne = $donne;

        return $this;
    }

    public function getBook()
    {
        return $this->book;
    }

    public function setBook(int $book): self
    {
        $this->book = $book;

        return $this;
    }
}
