<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\LignePanierRepository")
 */
class LignePanier
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="float")
     */
    private $quantitearticle;

    

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Panier", inversedBy="ligne_article")
     * @ORM\JoinColumn(nullable=false)
     */
    private $n_panier;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Article", inversedBy="lignePaniers")
     */
    private $LignesPanier;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getQuantitearticle(): ?float
    {
        return $this->quantitearticle;
    }

    public function setQuantitearticle(float $quantitearticle): self
    {
        $this->quantitearticle = $quantitearticle;

        return $this;
    }

   

    public function getNPanier(): ?Panier
    {
        return $this->n_panier;
    }

    public function setNPanier(?Panier $n_panier): self
    {
        $this->n_panier = $n_panier;

        return $this;
    }

    public function getLignesPanier(): ?Article
    {
        return $this->LignesPanier;
    }

    public function setLignesPanier(?Article $LignesPanier): self
    {
        $this->LignesPanier = $LignesPanier;

        return $this;
    }
}
