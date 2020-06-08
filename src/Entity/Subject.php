<?php

namespace App\Entity;
// Subject entity has one genre
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\SubjectRepository")
 */
class Subject
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
    private $label;

    /**
     * @ORM\Column(type="integer")
     * @ORM\ManyToOne(targetEntity="Genre")
     * @ORM\JoinColumn(name="genre", referencedColumnName="id")
     */
    private $Genre;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $numBook;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLabel(): ?string
    {
        return $this->label;
    }

    public function setLabel(string $label): self
    {
        $this->label = $label;

        return $this;
    }

    public function getGenre(): ?int
    {
        return $this->Genre;
    }

    public function setGenre(int $Genre): self
    {
        $this->Genre = $Genre;

        return $this;
    }

    public function getNumBook(): ?int
    {
        return $this->numBook;
    }

    public function setNumBook(?int $numBook): self
    {
        $this->numBook = $numBook;

        return $this;
    }
}
