<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\FactureRepository")
 */
class Facture
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
    private $titre;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $UserName;

    /**
     * @ORM\Column(type="float")
     */
    private $PrixTotal;

    /**
     * @ORM\Column(type="boolean")
     */
    private $transaction;

    /**
     * @ORM\Column(type="text")
     */
    private $descrptionFacture;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $devis;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitre(): ?string
    {
        return $this->titre;
    }

    public function setTitre(string $titre): self
    {
        $this->titre = $titre;

        return $this;
    }

    public function getUserName(): ?string
    {
        return $this->UserName;
    }

    public function setUserName(string $UserName): self
    {
        $this->UserName = $UserName;

        return $this;
    }

    public function getPrixTotal(): ?float
    {
        return $this->PrixTotal;
    }

    public function setPrixTotal(float $PrixTotal): self
    {
        $this->PrixTotal = $PrixTotal;

        return $this;
    }

    public function getTransaction(): ?bool
    {
        return $this->transaction;
    }

    public function setTransaction(bool $transaction): self
    {
        $this->transaction = $transaction;

        return $this;
    }

    public function getDescrptionFacture(): ?string
    {
        return $this->descrptionFacture;
    }

    public function setDescrptionFacture(string $descrptionFacture): self
    {
        $this->descrptionFacture = $descrptionFacture;

        return $this;
    }

    public function getDevis(): ?string
    {
        return $this->devis;
    }

    public function setDevis(string $devis): self
    {
        $this->devis = $devis;

        return $this;
    }
}
