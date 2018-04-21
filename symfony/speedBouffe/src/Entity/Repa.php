<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\RepaRepository")
 */
class Repa
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
    private $Nom;

    /**
     * @ORM\Column(type="integer")
     */
    private $Entree;

    /**
     * @ORM\Column(type="integer")
     */
    private $Dessert;

    public function getId()
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->Nom;
    }

    public function setNom(string $Nom): self
    {
        $this->Nom = $Nom;

        return $this;
    }

    public function getEntree(): ?int
    {
        return $this->Entree;
    }

    public function setEntree(int $Entree): self
    {
        $this->Entree = $Entree;

        return $this;
    }

    public function getDessert(): ?int
    {
        return $this->Dessert;
    }

    public function setDessert(int $Dessert): self
    {
        $this->Dessert = $Dessert;

        return $this;
    }
}
