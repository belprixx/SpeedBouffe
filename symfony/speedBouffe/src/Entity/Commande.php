<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use \DateTime;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CommandeRepository")
 */
class Commande
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="date")
     */
    private $Jour;

    /**
     * @ORM\Column(type="time")
     */
    private $Horaire_livraison;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Paiement_espece;

    /**
     * @ORM\Column(type="integer")
     */
    private $IdAcheteur;

    public function getId()
    {
        return $this->id;
    }

    public function getJour(): ?\DateTimeInterface
    {
        return $this->Jour;
    }

    public function setJour(\DateTimeInterface $Jour): self
    {
        $this->Jour = $Jour;

        return $this;
    }

    public function getHoraireLivraison(): ?\DateTimeInterface
    {
        return $this->Horaire_livraison;
    }

    public function setHoraireLivraison(\DateTimeInterface $Horaire_livraison): self
    {
        $this->Horaire_livraison = $Horaire_livraison;

        return $this;
    }

    public function getPaiementEspece(): ?bool
    {
        return $this->Paiement_espece;
    }

    public function setPaiementEspece(bool $Paiement_espece): self
    {
        $this->Paiement_espece = $Paiement_espece;

        return $this;
    }

    public function getIdAcheteur(): ?int
    {
        return $this->IdAcheteur;
    }

    public function setIdAcheteur(int $IdAcheteur): self
    {
        $this->IdAcheteur = $IdAcheteur;

        return $this;
    }
}
