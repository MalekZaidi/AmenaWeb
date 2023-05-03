<?php

namespace App\Entity;

use App\Repository\ValidationRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;


#[ORM\Entity(repositoryClass: ValidationRepository::class)]
#[ORM\Table(name: '`validation`')]




class Validation
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255, name: "imageA")]
    #[Assert\NotBlank]
    #[Assert\Url]
    private ?string $imagea = null;

    #[ORM\Column(length: 255, name: "imageB")]
    #[Assert\NotBlank]
    #[Assert\Url]
    private ?string $imageb = null;

    #[ORM\Column(name: "valide")]
    private ?bool $valide = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false, name: "idu")]
    private ?User $idu = null;




    public function getId(): ?int
    {
        return $this->id;
    }

    public function getImagea(): ?string
    {
        return $this->imagea;
    }

    public function setImagea(string $imagea): self
    {
        $this->imagea = $imagea;

        return $this;
    }

    public function getImageb(): ?string
    {
        return $this->imageb;
    }

    public function setImageb(string $imageb): self
    {
        $this->imageb = $imageb;

        return $this;
    }

    public function isValide(): ?bool
    {
        return $this->valide;
    }

    public function setValide(bool $valide): self
    {
        $this->valide = $valide;

        return $this;
    }

    public function getIdu(): ?User
    {
        return $this->idu;
    }

    public function setIdu(?User $idu): self
    {
        $this->idu = $idu;

        return $this;
    }
}
