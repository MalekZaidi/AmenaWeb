<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use App\Repository\CompetitionRepository ; 


#[ORM\Table(name: 'Competition')]
#[ORM\Entity(repositoryClass :CompetitionRepository::class)]
class Competition
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id=null;

    #[Assert\NotBlank(message:"Le titre ne doit pas être vide")]
    #[Assert\Length(max:10,maxMessage:"La longueur maximale du titre est 10")]
    #[ORM\Column(length:150)]
    private ?String $title=null;

    #[Assert\NotBlank(message:"La date de début ne doit pas être vide")]
 //   #[Assert\GreaterThanOrEqual(propertyPath: "dateDeb", message: "La date de début ne peut pas être antérieure à aujourd'hui")]
    //#[Assert\GreaterThan("today")]
    #[ORM\Column(nullable : false,type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $dateDeb;

   // #[Assert\GreaterThan("dateDeb")]
    #[Assert\NotBlank(message:"La date de fin ne doit pas être vide")]
  //  #[Assert\GreaterThan(propertyPath: "dateDeb", message: "La date de fin doit être postérieure à la date de début")]
    #[ORM\Column(nullable : false,type: Types::DATE_MUTABLE)] 
    private ?\DateTimeInterface $dateFin;

    #[Assert\NotBlank(message:"Le type ne doit pas être vide")]
    #[ORM\Column]
    private ?int $type;

    #[ORM\Column(nullable : true)]
    private ?int $nbp = 0 ;

    #[ORM\Column(name : 'id_uc')]
    private ?int $id_uc=163 ;

    #[ORM\OneToMany(mappedBy: 'idC', targetEntity: Gifts::class)]
    private Collection $gifts;

    #[ORM\ManyToMany(targetEntity: User::class, inversedBy: 'competitions')]
    private Collection $userPart;

    public function __construct()
    {
        $this->gifts = new ArrayCollection();
        $this->userPart = new ArrayCollection();
    }


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getDateDeb(): ?\DateTimeInterface
    {
        return $this->dateDeb;
    }

    public function setDateDeb(\DateTimeInterface $dateDeb): self
    {
        $this->dateDeb = $dateDeb;

        return $this;
    }

    public function getDateFin(): ?\DateTimeInterface
    {
        return $this->dateFin;
    }

    public function setDateFin(\DateTimeInterface $dateFin): self
    {
        $this->dateFin = $dateFin;

        return $this;
    }

    public function getType(): ?int
    {
        return $this->type;
    }

    public function setType(int $type): self
    {
        $this->type = $type;

        return $this;
    }

    public function getNbp(): ?int
    {
        return $this->nbp;
    }

    public function setNbp(int $nbp): self
    {
        $this->nbp = $nbp;

        return $this;
    }

    public function getIdUc(): ?int
    {
        return $this->id_uc;
    }

    public function setIdUc(int $id_uc): self
    {
        $this->id_uc = $id_uc;

        return $this;
    }

    /**
     * @return Collection<int, Gifts>
     */
    public function getGifts(): Collection
    {
        return $this->gifts;
    }

    public function addGift(Gifts $gift): self
    {
        if (!$this->gifts->contains($gift)) {
            $this->gifts->add($gift);
            $gift->setIdC($this);
        }

        return $this;
    }

    public function removeGift(Gifts $gift): self
    {
        if ($this->gifts->removeElement($gift)) {
            // set the owning side to null (unless already changed)
            if ($gift->getIdC() === $this) {
                $gift->setIdC(null);
            }
        }

        return $this;
    }
    public function __toString(): string
    {
        return $this->getId();
    }

    /**
     * @return Collection<int, User>
     */
    public function getUserPart(): Collection
    {
        return $this->userPart;
    }

    public function addUserPart(User $userPart): self
    {
        if (!$this->userPart->contains($userPart)) {
            $this->userPart->add($userPart);
        }

        return $this;
    }

    public function removeUserPart(User $userPart): self
    {
        $this->userPart->removeElement($userPart);

        return $this;
    }
}