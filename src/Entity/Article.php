<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;



/**
 * @ORM\Entity(repositoryClass="App\Repository\ArticleRepository")
 */
class Article
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     *  * @Assert\Length(
     *      min = 5,
     *      max = 50,
     *      minMessage = "Your first name must be at least {{ limit }} characters long",
     *      maxMessage = "Your first name cannot be longer than {{ limit }} characters"
     * )
     */
    private $title;

    /**
     * @ORM\Column(type="text")
     *  * @Assert\Length(
     *      min = 10
     * )
     */
    private $content;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Url
     */
    private $image;

    /**
     * @ORM\Column(type="datetime")
     */
    private $createdAt;

    /**
     * @ORM\Column(type="float")
     * @Assert\Type("float"),
     * message="En chiffre stp"
     */
    private $prix;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Category", inversedBy="articles")
     * @ORM\JoinColumn(nullable=false)
     */
    private $category;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Comment", mappedBy="article", orphanRemoval=true)
     */
    private $comments;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\LignePanier", mappedBy="LignesPanier")
     */
    private $lignePaniers;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Contenucommande", mappedBy="article")
     */
    private $contenucommandes;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $Quantity;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $barcode;

    public function __construct()
    {
        $this->comments = new ArrayCollection();
        $this->lignePaniers = new ArrayCollection();
        $this->contenucommandes = new ArrayCollection();
    }

    public function __toString()
    {
        return $this->getTitle();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getContent(): ?string
    {
        return $this->content;
    }

    public function setContent(string $content): self
    {
        $this->content = $content;

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(string $image): self
    {
        $this->image = $image;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;

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

    public function getCategory(): ?Category
    {
        return $this->category;
    }

    public function setCategory(?Category $category): self
    {
        $this->category = $category;

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
            $comment->setArticle($this);
        }

        return $this;
    }

    public function removeComment(Comment $comment): self
    {
        if ($this->comments->contains($comment)) {
            $this->comments->removeElement($comment);
            // set the owning side to null (unless already changed)
            if ($comment->getArticle() === $this) {
                $comment->setArticle(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|LignePanier[]
     */
    public function getLignePaniers(): Collection
    {
        return $this->lignePaniers;
    }

    public function addLignePanier(LignePanier $lignePanier): self
    {
        if (!$this->lignePaniers->contains($lignePanier)) {
            $this->lignePaniers[] = $lignePanier;
            $lignePanier->setLignesPanier($this);
        }

        return $this;
    }

    public function removeLignePanier(LignePanier $lignePanier): self
    {
        if ($this->lignePaniers->contains($lignePanier)) {
            $this->lignePaniers->removeElement($lignePanier);
            // set the owning side to null (unless already changed)
            if ($lignePanier->getLignesPanier() === $this) {
                $lignePanier->setLignesPanier(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Contenucommande[]
     */
    public function getContenucommandes(): Collection
    {
        return $this->contenucommandes;
    }

    public function addContenucommande(Contenucommande $contenucommande): self
    {
        if (!$this->contenucommandes->contains($contenucommande)) {
            $this->contenucommandes[] = $contenucommande;
            $contenucommande->setArticle($this);
        }

        return $this;
    }

    public function removeContenucommande(Contenucommande $contenucommande): self
    {
        if ($this->contenucommandes->contains($contenucommande)) {
            $this->contenucommandes->removeElement($contenucommande);
            // set the owning side to null (unless already changed)
            if ($contenucommande->getArticle() === $this) {
                $contenucommande->setArticle(null);
            }
        }

        return $this;
    }

    public function getQuantity(): ?int
    {
        return $this->Quantity;
    }

    public function setQuantity(?int $Quantity): self
    {
        $this->Quantity = $Quantity;

        return $this;
    }

    public function getBarcode(): ?string
    {
        return $this->barcode;
    }

    public function setBarcode(?string $barcode): self
    {
        $this->barcode = $barcode;

        return $this;
    }
 
}
