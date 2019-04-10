<?php

namespace App\Entity;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Symfony\Component\Validator\Constraints as Assert;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\EvenementRepository")
 */
class Evenement
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Length(min=4)
     */
    private $titre;

    /**
     * @ORM\Column(type="datetime")
     */
    private $debutAt;

    /**
     * @ORM\Column(type="datetime")
     * @Assert\GreaterThan(propertyPath="debutAt", message="date de fin apré la date de debut")
     */
    private $finAt;

    /**
     * @ORM\Column(type="float")
     */
    private $prix;

    /**
     * @ORM\Column(type="integer")
     */
    private $nbrPlace;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $image;

    /**
     * @ORM\Column(type="text")
      * @Assert\Length(min=10)
     */
    private $description;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $lieux;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Category", inversedBy="evenements")
     */
    private $category;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Devise", inversedBy="evenements")
     */
    private $devises;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Comment", mappedBy="evenement")
     */
    private $comments;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\CategoryPrice", mappedBy="event")
     */
    private $categoryPrices;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\PostLike", mappedBy="post")
     */
    private $likes;

    public function __construct()
    {
        $this->comments = new ArrayCollection();
        $this->categoryPrices = new ArrayCollection();
        $this->likes = new ArrayCollection();
    }

    


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

    public function getDebutAt(): ?\DateTimeInterface
    {
        return $this->debutAt;
    }

    public function setDebutAt(\DateTimeInterface $debutAt): self
    {
        $this->debutAt = $debutAt;

        return $this;
    }

    public function getFinAt(): ?\DateTimeInterface
    {
        return $this->finAt;
    }

    public function setFinAt(\DateTimeInterface $finAt): self
    {
        $this->finAt = $finAt;

        return $this;
    }

    public function getPrix(): ?float
    {
        return $this->prix;
    }

    public function setPrix(float $prix): self
    {
        $this->prix = $prix;

        return $this;
    }

    public function getNbrPlace(): ?int
    {
        return $this->nbrPlace;
    }

    public function setNbrPlace(int $nbrPlace): self
    {
        $this->nbrPlace = $nbrPlace;

        return $this;
    }

    public function getImage()
    {
        return $this->image;
    }

    public function setImage($image)
    {
        $this->image = $image;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getLieux(): ?string
    {
        return $this->lieux;
    }

    public function setLieux(string $lieux): self
    {
        $this->lieux = $lieux;

        return $this;
    }

    public function getCategory(): ?Category
    {
        return $this->category;
    }

    public function setCategory(?Category $category): self
    {
        $this->category = $category;

        return $this;
    }

    public function getDevises(): ?Devise
    {
        return $this->devises;
    }

    public function setDevises(?Devise $devises): self
    {
        $this->devises = $devises;

        return $this;
    }

    /**
     * @return Collection|Comment[]
     */
    public function getComments(): Collection
    {
        return $this->comments;
    }

    public function addComment(Comment $comment): self
    {
        if (!$this->comments->contains($comment)) {
            $this->comments[] = $comment;
            $comment->setEvenement($this);
        }

        return $this;
    }

    public function removeComment(Comment $comment): self
    {
        if ($this->comments->contains($comment)) {
            $this->comments->removeElement($comment);
            // set the owning side to null (unless already changed)
            if ($comment->getEvenement() === $this) {
                $comment->setEvenement(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|CategoryPrice[]
     */
    public function getCategoryPrices(): Collection
    {
        return $this->categoryPrices;
    }

    public function addCategoryPrice(CategoryPrice $categoryPrice): self
    {
        if (!$this->categoryPrices->contains($categoryPrice)) {
            $this->categoryPrices[] = $categoryPrice;
            $categoryPrice->setEvent($this);
        }

        return $this;
    }

    public function removeCategoryPrice(CategoryPrice $categoryPrice): self
    {
        if ($this->categoryPrices->contains($categoryPrice)) {
            $this->categoryPrices->removeElement($categoryPrice);
            // set the owning side to null (unless already changed)
            if ($categoryPrice->getEvent() === $this) {
                $categoryPrice->setEvent(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|PostLike[]
     */
    public function getLikes(): Collection
    {
        return $this->likes;
    }
    /**
     * ajouter un like
     *
     * @param PostLike $like
     * @return self
     */
    public function addLike(PostLike $like): self
    {
        if (!$this->likes->contains($like)) {
            $this->likes[] = $like;
            $like->setPost($this);
        }

        return $this;
    }
    /**
     * suprimer un like
     *
     * @param PostLike $like
     * @return self
     */
    public function removeLike(PostLike $like): self
    {
        if ($this->likes->contains($like)) {
            $this->likes->removeElement($like);
            // set the owning side to null (unless already changed)
            if ($like->getPost() === $this) {
                $like->setPost(null);
            }
        }

        return $this;
    }
    /**
     * Undocumented function pour savoir qui aime l event 
     *
     * @param User $user
     * @return boolean
     */
    public function isLikedByUser(User $user): bool
    {
        foreach ($this->likes as $like) {
            if ($like->getUser() === $user) return true;
        }
        return false;
    }
   
}
