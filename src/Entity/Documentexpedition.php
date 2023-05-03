<?php

namespace App\Entity;
use App\Repository\DocumentexpeditionRepository;
use App\Entity\Colis;
use DateTimeInterface;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Table(name: '`DocumentExpedition`')]
#[ORM\Entity(repositoryClass: DocumentexpeditionRepository::class)]

class Documentexpedition
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

  
    #[ORM\Column(type: Types::DATE_MUTABLE, name: "datesignature")]
    private ?DateTimeInterface $datesignature= null;




    #[ORM\Column(length: 50, name: "statut")]
    #[Assert\NotBlank(message: "Statut  obligatoire")]
    private ?string $statut= null;

    #[ORM\OneToOne]
    #[ORM\JoinColumn(nullable: false, name:"colis_id")]
    private ?Colis $colis_id = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank(message: "Description obligatoire")]
    private ?string $Description = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDatesignature(): ?\DateTimeInterface
    {
        return $this->datesignature;
    }

    public function setDatesignature(\DateTimeInterface $datesignature): self
    {
        $this->datesignature = $datesignature;

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

    public function getColisId(): ?Colis
    {
        return $this->colis_id;
    }

    public function setColisId(Colis $colis_id): self
    {
        $this->colis_id = $colis_id;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->Description;
    }

    public function setDescription(string $Description): self
    {
        $this->Description = $Description;

        return $this;
    }
    public function __construct()
    {
       /* $this->annonces = new ArrayCollection();*/
       $this->datesignature = new \DateTimeImmutable('now');
       
    }

}
