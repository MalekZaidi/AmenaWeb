<?php

namespace App\Entity;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

/**
 * Message
 *
 * @ORM\Table(name="message")
 * @ORM\Entity
 */
class Message
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
     * @var int
     *
     * @ORM\Column(name="senderId", type="integer", nullable=false)
     */
    private $senderid;

    /**
     * @var int
     *
     * @ORM\Column(name="receiverId", type="integer", nullable=false)
     */
    private $receiverid;

    /**
     * @var string
     *
     * @ORM\Column(name="content", type="string", length=255, nullable=false)
     */
    private $content;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="timestamp", type="date", nullable=false)
     */
    private $timestamp;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSenderid(): ?int
    {
        return $this->senderid;
    }

    public function setSenderid(int $senderid): self
    {
        $this->senderid = $senderid;

        return $this;
    }

    public function getReceiverid(): ?int
    {
        return $this->receiverid;
    }

    public function setReceiverid(int $receiverid): self
    {
        $this->receiverid = $receiverid;

        return $this;
    }

    public function getContent(): ?string
    {
        return $this->content;
    }

    public function setContent(string $content): self
    {
        $this->content = $content;

        return $this;
    }

    public function getTimestamp(): ?\DateTimeInterface
    {
        return $this->timestamp;
    }

    public function setTimestamp(\DateTimeInterface $timestamp): self
    {
        $this->timestamp = $timestamp;

        return $this;
    }


}
