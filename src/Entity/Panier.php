<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

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
     * @ORM\OneToMany(targetEntity="App\Entity\LignePanier", mappedBy="n_panier", orphanRemoval=true)
     */
    private $ligne_article;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\User")
     * @ORM\JoinColumn(nullable=false)
     */
    private $nom_client;

    public function __construct()
    {
        $this->ligne_article = new ArrayCollection();
    }
    public function __toString()
    {
        return $this->getInfo();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Collection|LignePanier[]
     */
    public function getLigneArticle(): Collection
    {
        return $this->ligne_article;
    }

    public function addLigneArticle(LignePanier $ligneArticle): self
    {
        if (!$this->ligne_article->contains($ligneArticle)) {
            $this->ligne_article[] = $ligneArticle;
            $ligneArticle->setNPanier($this);
        }

        return $this;
    }

    public function removeLigneArticle(LignePanier $ligneArticle): self
    {
        if ($this->ligne_article->contains($ligneArticle)) {
            $this->ligne_article->removeElement($ligneArticle);
            // set the owning side to null (unless already changed)
            if ($ligneArticle->getNPanier() === $this) {
                $ligneArticle->setNPanier(null);
            }
        }

        return $this;
    }

    public function getNomClient(): ?user
    {
        return $this->nom_client;
    }

    public function setNomClient(?user $nom_client): self
    {
        $this->nom_client = $nom_client;

        return $this;
    }

    public function getTotal(): float
    {
        $letotal = 0;
        foreach ($this->ligne_article as $uneligne){
            $letotal += $uneligne->getLignesPanier()->getPrix() * $uneligne->getQuantitearticle();
         }
    return $letotal;
    } 
    
}
