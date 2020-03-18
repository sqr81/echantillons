<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\EtudeRepository")
 * @UniqueEntity("numero")
 */
class Etude
{
    const ESPECE = [
        0 => 'souris',
        1 => 'rat',
        2 => 'furet',
        3 => 'mini cochon',
        4 => 'chien'
    ];
    const STATUT = [
        0 => 'stocké',
        1 => 'en cours',
        2 => 'envoyé',
        3 => 'détruit'
    ];

    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @Assert\Regex("/^[0-9]{6}+/")
     * @ORM\Column(type="string", length=255)
     */
    private $numero;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $sponsor;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $test;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $DE;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $tre;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $espece;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $statut;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $commentaire;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $commercial;

    /**
     * @ORM\Column(type="string", length=255)
     */
    /*private $representant_sponsor;*/

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Phase", inversedBy="etudes")
     */
    /*private $phase;*/

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\User", mappedBy="etude")
     */
    private $users;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Produit", mappedBy="etude")
     */
    private $produits;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $representantSponsor;

    public function __construct()
    {
        $this->users = new ArrayCollection();
        $this->produits = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNumero(): ?string
    {
        return $this->numero;
    }

    public function setNumero(string $numero): self
    {
        $this->numero = $numero;

        return $this;
    }

    public function getSponsor(): ?string
    {
        return $this->sponsor;
    }

    public function setSponsor(string $sponsor): self
    {
        $this->sponsor = $sponsor;

        return $this;
    }

    public function getTest(): ?string
    {
        return $this->test;
    }

    public function setTest(string $test): self
    {
        $this->test = $test;

        return $this;
    }

    public function getDE(): ?string
    {
        return $this->DE;
    }

    public function setDE(string $DE): self
    {
        $this->DE = $DE;

        return $this;
    }

    public function getTre(): ?string
    {
        return $this->tre;
    }

    public function setTre(string $tre): self
    {
        $this->tre = $tre;

        return $this;
    }

    public function getEspece(): ?string
    {
        return $this->espece;
    }

    public function setEspece(string $espece): self
    {
        $this->espece = $espece;

        return $this;
    }

    public function getStatut(): ?string
    {
        return $this->statut;
    }

    public function setStatut(string $statut): self
    {
        $this->statut = $statut;

        return $this;
    }

    public function getCommentaire(): ?string
    {
        return $this->commentaire;
    }

    public function setCommentaire(string $commentaire): self
    {
        $this->commentaire = $commentaire;

        return $this;
    }

    public function getCommercial(): ?string
    {
        return $this->commercial;
    }

    public function setCommercial(string $commercial): self
    {
        $this->commercial = $commercial;

        return $this;
    }

    /**
     * @return Collection|User[]
     */
    public function getUsers(): Collection
    {
        return $this->users;
    }

    public function addUser(User $user): self
    {
        if (!$this->users->contains($user)) {
            $this->users[] = $user;
            $user->setEtude($this);
        }

        return $this;
    }

    public function removeUser(User $user): self
    {
        if ($this->users->contains($user)) {
            $this->users->removeElement($user);
            // set the owning side to null (unless already changed)
            if ($user->getEtude() === $this) {
                $user->setEtude(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Produit[]
     */
    public function getProduits(): Collection
    {
        return $this->produits;
    }

    public function addProduit(Produit $produit): self
    {
        if (!$this->produits->contains($produit)) {
            $this->produits[] = $produit;
            $produit->setEtude($this);
        }

        return $this;
    }

    public function removeProduit(Produit $produit): self
    {
        if ($this->produits->contains($produit)) {
            $this->produits->removeElement($produit);
            // set the owning side to null (unless already changed)
            if ($produit->getEtude() === $this) {
                $produit->setEtude(null);
            }
        }

        return $this;
    }

    public function getRepresentantSponsor(): ?string
    {
        return $this->representantSponsor;
    }

    public function setRepresentantSponsor(string $representantSponsor): self
    {
        $this->representantSponsor = $representantSponsor;

        return $this;
    }
}