<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\PanierRepository")
 */
class Panier
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="paniers")
     */
    private $users;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\CategoryPrice", inversedBy="paniers")
     */
    private $pack;

    /**
     * @ORM\Column(type="integer")
     */
    private $NbrPlace;

    /**
     * @ORM\Column(type="boolean")
     */
    private $Active;
    
    

    public function getId(): ?int
    {
        return $this->id;
    }

    

    public function getUsers(): ?User
    {
        return $this->users;
    }

    public function setUsers(?User $users): self
    {
        $this->users = $users;

        return $this;
    }

    public function getPack(): ?CategoryPrice
    {
        return $this->pack;
    }

    public function setPack(?CategoryPrice $pack): self
    {
        $this->pack = $pack;

        return $this;
    }

    public function getNbrPlace(): ?int
    {
        return $this->NbrPlace;
    }

    public function setNbrPlace(int $NbrPlace): self
    {
        $this->NbrPlace = $NbrPlace;

        return $this;
    }

    public function getActive(): ?bool
    {
        return $this->Active;
    }

    public function setActive(bool $Active): self
    {
        $this->Active = $Active;

        return $this;
    }
}
