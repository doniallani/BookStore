<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\BookRepository")
 */
class Book
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string")
     */
    private $name;

    /**
     * @ORM\Column(type="string")
     */
    private $author;

    /**
     * @ORM\Column(type="string", nullable=true)
     */
    private $genre;

    /**
     * @ORM\Column(type="string", nullable=true)
     */
    private $dateEdition;

    /**
     * @ORM\Column(type="string", nullable=true)
     */
    private $maisonEdition;

    /**
     * @ORM\Column(type="string", nullable=true)
     */
    private $etat;

    /**
     * @ORM\Column(type="string", nullable=true)
     */
    private $nombrePage;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $action;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $subject;

    /**
     * @ORM\Column(type="integer")
     * @ORM\ManyToOne(targetEntity="Admin")
     * @ORM\JoinColumn(name="admin", referencedColumnName="id")
     */
    private $user;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $price;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $rate;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $numRate;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $img;

    
    

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getAuthor(): ?string
    {
        return $this->author;
    }

    public function setAuthor(string $author): self
    {
        $this->author = $author;

        return $this;
    }

    public function getGenre(): ?string
    {
        return $this->genre;
    }

    public function setGenre(?string $genre): self
    {
        $this->genre = $genre;

        return $this;
    }

    public function getDateEdition() 
    {
        return $this->dateEdition;
    }

    public function setDateEdition(string $dateEdition): self
    {
        $this->dateEdition = $dateEdition;

        return $this;
    }

    public function getMaisonEdition(): ?string
    {
        return $this->maisonEdition;
    }

    public function setMaisonEdition(?string $maisonEdition): self
    {
        $this->maisonEdition = $maisonEdition;

        return $this;
    }

    public function getEtat(): ?string
    {
        return $this->etat;
    }

    public function setEtat(?string $etat): self
    {
        $this->etat = $etat;

        return $this;
    }

    public function getNombrePage(): ?string
    {
        return $this->nombrePage;
    }

    public function setNombrePage(?string $nombrePage): self
    {
        $this->nombrePage = $nombrePage;

        return $this;
    }

    public function getAction(): ?string
    {
        return $this->action;
    }

    public function setAction(string $action): self
    {
        $this->action = $action;

        return $this;
    }

    public function getSubject(): ?string
    {
        return $this->subject;
    }

    public function setSubject(string $subject): self
    {
        $this->subject = $subject;

        return $this;
    }

    public function getUser()
    {
        return $this->user;
    }

    public function setUser(int $user): self
    {
        $this->user = $user;

        return $this;
    }

    public function getPrice(): ?string
    {
        return $this->price;
    }

    public function setPrice(string $price): self
    {
        $this->price = $price;

        return $this;
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

    public function getNumRate(): ?int
    {
        return $this->numRate;
    }

    public function setNumRate(?int $numRate): self
    {
        $this->numRate = $numRate;

        return $this;
    }

    public function getImg(): ?string
    {
        return $this->img;
    }

    public function setImg(?string $img): self
    {
        $this->img = $img;

        return $this;
    }

   

   

   
}
