<?php

namespace App\Entity;
use Doctrine\DBAL\Types\Types;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\VehiculeRepository ; 
#[ORM\Table(name: '`vehicule`')]

#[ORM\Entity(repositoryClass :VehiculeRepository::class)]
class Vehicule
{
   
 
   #[ORM\Id]
   #[ORM\GeneratedValue]
   #[ORM\Column]
   private ?int $idv=null;


    #[ORM\Column(length: 30)]
    private ?string $type = null ; 

    #[ORM\Column(length: 30)]
    private ?string $immat = null ; 

    #[ORM\Column]
    private ?bool $etat=false ;

    #[ORM\Column(length: 30)]
    private ?string $kilometrage = null ; 
  
    #[ORM\Column]
    private ?int $chevaux=0 ;

    #[ORM\Column(length: 30)]
    private ?string $marque = null ;
    
    #[ORM\Column(length: 30)]
    private ?string $modele = null ;
    
    #[ORM\Column(length: 15)]
    private ?string $couleur = null ;

   
    #[ORM\Column]
    private ?float $prix = null ;

    #[ORM\Column(length: 150)]
    private ?string $img = null ;
 

    public function getIdv(): ?int
    {
        return $this->idv;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): self
    {
        $this->type = $type;

        return $this;
    }

    public function getImmat(): ?string
    {
        return $this->immat;
    }

    public function setImmat(string $immat): self
    {
        $this->immat = $immat;

        return $this;
    }

    public function isEtat(): ?bool
    {
        return $this->etat;
    }

    public function setEtat(bool $etat): self
    {
        $this->etat = $etat;

        return $this;
    }

    public function getKilometrage(): ?string
    {
        return $this->kilometrage;
    }

    public function setKilometrage(string $kilometrage): self
    {
        $this->kilometrage = $kilometrage;

        return $this;
    }

    public function getChevaux(): ?int
    {
        return $this->chevaux;
    }

    public function setChevaux(int $chevaux): self
    {
        $this->chevaux = $chevaux;

        return $this;
    }

    public function getMarque(): ?string
    {
        return $this->marque;
    }

    public function setMarque(string $marque): self
    {
        $this->marque = $marque;

        return $this;
    }

    public function getModele(): ?string
    {
        return $this->modele;
    }

    public function setModele(string $modele): self
    {
        $this->modele = $modele;

        return $this;
    }

    public function getCouleur(): ?string
    {
        return $this->couleur;
    }

    public function setCouleur(string $couleur): self
    {
        $this->couleur = $couleur;

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

    public function getImg(): ?string
    {
        return $this->img;
    }

    public function setImg(string $img): self
    {
        $this->img = $img;

        return $this;
    }


}