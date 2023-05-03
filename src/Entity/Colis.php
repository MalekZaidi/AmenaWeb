<?php

namespace App\Entity;

use App\Repository\ColisRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Table(name: '`colis`')]
#[ORM\Entity(repositoryClass: ColisRepository::class)]
class Colis
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups("colis")]
    private ?int $id = null;

    #[ORM\Column(length: 50, name: "nomExpediteur")]
    #[Groups("colis")]
    #[Assert\NotBlank(message: "Nom de l'expéditeur obligatoire")]
    #[Assert\Regex(pattern: '/^[a-zA-Z\s]+$/', message: "Le nom de l'expéditeur ne doit contenir que des lettres et des espaces")]
    #[Assert\Length(max: 50, maxMessage: "Le nom de l'expéditeur ne doit pas dépasser {{ limit }} caractères")]
    private ?string $nomExpediteur = null;

    #[ORM\Column(length: 50, name: "adresseExpediteur")]
    #[Groups("colis")]
    #[Assert\NotBlank(message: "Adresse de l'expéditeur obligatoire")]
    #[Assert\Length(max: 50, maxMessage: "L'adresse de l'expéditeur ne doit pas dépasser {{ limit }} caractères")]
    private ?string $adresseExpediteur = null;
    
    #[ORM\Column(length: 50, name: "nomDestinataire")]
    #[Groups("colis")]
    #[Assert\NotBlank(message: "Nom du destinataire obligatoire")]
    #[Assert\Regex(pattern: '/^[a-zA-Z\s]+$/', message: "Le nom du destinataire ne doit contenir que des lettres et des espaces")]
    #[Assert\Length(max: 50, maxMessage: "Le nom du destinataire ne doit pas dépasser {{ limit }} caractères")]
    private ?string $nomDestinataire = null;

    #[ORM\Column(length: 50, name: "adresseDestinataire")]
    #[Groups("colis")]
    #[Assert\NotBlank(message: "Adresse du destinataire obligatoire")]
    #[Assert\Length(max: 50, maxMessage: "L'adresse du destinataire ne doit pas dépasser {{ limit }} caractères")]
    private ?string $adresseDestinataire = null;

    #[ORM\Column(name: "poids")]
    #[Groups("colis")]
    #[Assert\NotBlank(message: "Poids obligatoire")]
    #[Assert\Positive(message: "Le poids doit être supérieur à 0")]
    private ?float $poids = null;

    #[ORM\Column(length: 30, name: "statut")]
    #[Groups("colis")]
    private ?string $statut = null;

    #[ORM\Column(type: Types::DATE_MUTABLE, name: "dateExpedition")]
    #[Groups("colis")]
    private ?\DateTimeInterface $dateExpedition = null;




    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false, name: "id_u ")]
    #[Groups("colis")]
    private ?User $id_u  = null;

    /*#[ORM\OneToMany(mappedBy: 'idColis', targetEntity: Annonces::class)]
    private Collection $annonces;*/

    public function __construct()
    {
       /* $this->annonces = new ArrayCollection();*/
        $this->dateExpedition = new \DateTimeImmutable('now');
        $this->statut = 'en attente';
    }


    /*#[ORM\OneToMany(mappedBy: 'idColis', targetEntity: Annonces::class)]
    private Collection $annonces;*/

    /*#[ORM\OneToMany(mappedBy: 'idcolis', targetEntity: Annonces::class)]
    private Collection $idcccc;*/

   /* public function __construct()
    {
        $this->annonces = new ArrayCollection();
       // $this->idcccc = new ArrayCollection();
    }*/

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomExpediteur(): ?string
    {
        return $this->nomExpediteur;
    }

    public function setNomExpediteur(string $nomExpediteur): self
    {
        $this->nomExpediteur = $nomExpediteur;

        return $this;
    }

    public function getAdresseExpediteur(): ?string
    {
        return $this->adresseExpediteur;
    }

    public function setAdresseExpediteur(string $adresseExpediteur): self
    {
        $this->adresseExpediteur = $adresseExpediteur;

        return $this;
    }

    public function getNomDestinataire(): ?string
    {
        return $this->nomDestinataire;
    }

    public function setNomDestinataire(string $nomDestinataire): self
    {
        $this->nomDestinataire = $nomDestinataire;

        return $this;
    }

    public function getAdresseDestinataire(): ?string
    {
        return $this->adresseDestinataire;
    }

    public function setAdresseDestinataire(string $adresseDestinataire): self
    {
        $this->adresseDestinataire = $adresseDestinataire;

        return $this;
    }

    public function getPoids(): ?float
    {
        return $this->poids;
    }

    public function setPoids(float $poids): self
    {
        $this->poids = $poids;

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

    public function getDateExpedition(): ?\DateTimeInterface
    {
        return $this->dateExpedition;
    }

    public function setDateExpedition(\DateTimeInterface $dateExpedition): self
    {
        $this->dateExpedition = $dateExpedition;

        return $this;
    }

    public function getIdU(): ?User
    {
        return $this->id_u;
    }

    public function setIdU(?User $id_u): self
    {
        $this->id_u = $id_u;

        return $this;
    }

  
    /*public function getAnnonces(): Collection
    {
        return $this->annonces;
    }*/

    /*public function addAnnonce(Annonces $annonce): self
    {
        if (!$this->annonces->contains($annonce)) {
            $this->annonces->add($annonce);
            $annonce->setIdColis($this);
        }

        return $this;
    }

    public function removeAnnonce(Annonces $annonce): self
    {
        if ($this->annonces->removeElement($annonce)) {
            // set the owning side to null (unless already changed)
            if ($annonce->getIdColis() === $this) {
                $annonce->setIdColis(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Annonces>
     */
   /* public function getIdcccc(): Collection
    {
        return $this->idcccc;
    }

    public function addIdcccc(Annonces $idcccc): self
    {
        if (!$this->idcccc->contains($idcccc)) {
            $this->idcccc->add($idcccc);
            $idcccc->setIdcolis($this);
        }

        return $this;
    }

    public function removeIdcccc(Annonces $idcccc): self
    {
        if ($this->idcccc->removeElement($idcccc)) {
            // set the owning side to null (unless already changed)
            if ($idcccc->getIdcolis() === $this) {
                $idcccc->setIdcolis(null);
            }
        }

        return $this;
    }
*/
    public function __toString()
    {
        return $this->nomExpediteur;
    }

   
    /**
     * @return Collection<int, Annonces>
     */
   /*   public function getAnnonces(): Collection
    {
        return $this->annonces;
    }

    public function addAnnonce(Annonces $annonce): self
    {
        if (!$this->annonces->contains($annonce)) {
            $this->annonces->add($annonce);
            $annonce->setIdColis($this);
        }

        return $this;
    }

    public function removeAnnonce(Annonces $annonce): self
    {
        if ($this->annonces->removeElement($annonce)) {
            // set the owning side to null (unless already changed)
            if ($annonce->getIdColis() === $this) {
                $annonce->setIdColis(null);
            }
        }

        return $this;
    }*/
}
