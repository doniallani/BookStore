<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\OrdeRepository")
 */
class Orde
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $book;

    /**
     * @ORM\Column(type="integer")
     */
    private $user;

    /**
     * @ORM\Column(type="integer")
     */
    private $cart;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getBook(): ?int
    {
        return $this->book;
    }

    public function setBook(int $book): self
    {
        $this->book = $book;

        return $this;
    }

    public function getUser(): ?int
    {
        return $this->user;
    }

    public function setUser(int $user): self
    {
        $this->user = $user;

        return $this;
    }

    public function getCart(): ?int
    {
        return $this->cart;
    }

    public function setCart(int $cart): self
    {
        $this->cart = $cart;

        return $this;
    }
}
