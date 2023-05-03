<?php

namespace App\Entity;

use App\Repository\IduRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: IduRepository::class)]
class Idu
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    public function getId(): ?int
    {
        return $this->id;
    }
}
