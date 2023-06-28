<?php

namespace App\Entity;

use App\Repository\ColisRecRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ColisRecRepository::class)]
class ColisRec
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'colisRec', cascade: ['persist', 'remove'])]
    private ?Colis $id_c = null;

    #[ORM\ManyToOne(inversedBy: 'colisRec', cascade: ['persist', 'remove'])]
    private ?User $id_u = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdC(): ?Colis
    {
        return $this->id_c;
    }

    public function setIdC(?Colis $id_c): self
    {
        $this->id_c = $id_c;

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
}
