<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ProduitRepository")
 */
class Produit
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
    private $id_produitPorsolt;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $groupe;

    /**
     * @ORM\Column(type="integer")
     */
    private $nbrAnimaux;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $voieAdmin;

    /**
     * @ORM\Column(type="datetime")
     */
    private $datePremierPrelevement;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $commentaire;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Groupe", mappedBy="produit")
     */
    private $groupes;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Phase", inversedBy="produits")
     */
    private $phase;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Etude", inversedBy="produits")
     */
    private $etude;

    public function __construct()
    {
        $this->groupes = new ArrayCollection();
    }

   

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdProduitPorsolt(): ?string
    {
        return $this->id_produitPorsolt;
    }

    public function setIdProduitPorsolt(string $id_produitPorsolt): self
    {
        $this->id_produitPorsolt = $id_produitPorsolt;

        return $this;
    }

    public function getGroupe(): ?string
    {
        return $this->groupe;
    }

    public function setGroupes(string $groupe): self
    {
        $this->groupe = $groupe;

        return $this;
    }

    public function getNbrAnimaux(): ?int
    {
        return $this->nbrAnimaux;
    }

    public function setNbrAnimaux(int $nbrAnimaux): self
    {
        $this->nbrAnimaux = $nbrAnimaux;

        return $this;
    }

    public function getVoieAdmin(): ?string
    {
        return $this->voieAdmin;
    }

    public function setVoieAdmin(string $voieAdmin): self
    {
        $this->voieAdmin = $voieAdmin;

        return $this;
    }

    public function getDatePremierPrelevement(): ?\DateTimeInterface
    {
        return $this->datePremierPrelevement;
    }

    public function setDatePremierPrelevement(\DateTimeInterface $datePremierPrelevement): self
    {
        $this->datePremierPrelevement = $datePremierPrelevement;

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

    /**
     * @return Collection|Groupe[]
     */
    public function getGroupes(): Collection
    {
        return $this->groupes;
    }

    public function addGroupe(Groupe $groupe): self
    {
        if (!$this->groupes->contains($groupe)) {
            $this->groupes[] = $groupe;
            $groupe->setProduit($this);
        }

        return $this;
    }

    public function removeGroupe(Groupe $groupe): self
    {
        if ($this->groupes->contains($groupe)) {
            $this->groupes->removeElement($groupe);
            // set the owning side to null (unless already changed)
            if ($groupe->getProduit() === $this) {
                $groupe->setProduit(null);
            }
        }

        return $this;
    }

    public function getPhase(): ?Phase
    {
        return $this->phase;
    }

    public function setPhase(?Phase $phase): self
    {
        $this->phase = $phase;

        return $this;
    }

    public function getEtude(): ?Etude
    {
        return $this->etude;
    }

    public function setEtude(?Etude $etude): self
    {
        $this->etude = $etude;

        return $this;
    }

   
}