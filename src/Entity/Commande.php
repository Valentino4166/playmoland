<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

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
     * @ORM\Column(type="float")
     */
    private $prixtotal;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="commandes")
     * @ORM\JoinColumn(nullable=false)
     */
    private $client;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Contenucommande", mappedBy="commande")
     */
    private $contenucommandes;

    public function __construct()
    {
        $this->contenucommandes = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPrixtotal(): ?float
    {
        return $this->prixtotal;
    }

    public function setPrixtotal(float $prixtotal): self
    {
        $this->prixtotal = $prixtotal;

        return $this;
    }

    public function getClient(): ?user
    {
        return $this->client;
    }

    public function setClient(?user $client): self
    {
        $this->client = $client;

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
            $contenucommande->setCommande($this);
        }

        return $this;
    }

    public function removeContenucommande(Contenucommande $contenucommande): self
    {
        if ($this->contenucommandes->contains($contenucommande)) {
            $this->contenucommandes->removeElement($contenucommande);
            // set the owning side to null (unless already changed)
            if ($contenucommande->getCommande() === $this) {
                $contenucommande->setCommande(null);
            }
        }

        return $this;
    }
}
