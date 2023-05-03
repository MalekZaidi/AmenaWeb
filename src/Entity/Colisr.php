<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Colisr
 *
 * @ORM\Table(name="colisr", indexes={@ORM\Index(name="fk_c1", columns={"id_c"}), @ORM\Index(name="fk_user", columns={"id_u"})})
 * @ORM\Entity
 */
class Colisr
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var \User
     *
     * @ORM\ManyToOne(targetEntity="User")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_u", referencedColumnName="id")
     * })
     */
    private $idU;

    /**
     * @var \Colis
     *
     * @ORM\ManyToOne(targetEntity="Colis")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_c", referencedColumnName="id_Colis")
     * })
     */
    private $idC;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdU(): ?User
    {
        return $this->idU;
    }

    public function setIdU(?User $idU): self
    {
        $this->idU = $idU;

        return $this;
    }

    public function getIdC(): ?Colis
    {
        return $this->idC;
    }

    public function setIdC(?Colis $idC): self
    {
        $this->idC = $idC;

        return $this;
    }


}
