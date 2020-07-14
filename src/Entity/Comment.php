<?php

namespace App\Entity;

use App\Repository\CommentRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CommentRepository::class)
 */
class Comment
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private ?int $id;

    /**
     * @ORM\Column(type="string", length=255,nullable=false)
     */
    private string $author;

    /**
     * @ORM\Column(type="text",nullable=false)
     */
    private string $text;

    /**
     * @ORM\Column(type="string", length=255,nullable=false)
     */
    private string $email;


    /**
     * @ORM\Column(type="string", length=255,nullable=true)
     */
    private ?string $photoFilename;

    /**
     * @ORM\Column(type="datetime")
     */
    private \DateTimeInterface $createdAt;

    /**
     * @var Conference
     * @ORM\ManyToOne(targetEntity=Conference::class,inversedBy="comments")
     */
    private Conference $conference;

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return string|null
     */
    public function getAuthor(): ?string
    {
        return $this->author;
    }

    /**
     * @param string $author
     * @return $this
     */
    public function setAuthor(string $author): self
    {
        $this->author = $author;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getText(): ?string
    {
        return $this->text;
    }

    /**
     * @param string $text
     * @return $this
     */
    public function setText(string $text): self
    {
        $this->text = $text;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getEmail(): ?string
    {
        return $this->email;
    }

    /**
     * @param string $email
     * @return $this
     */
    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    /**
     * @return \DateTimeInterface|null
     */
    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    /**
     * @param \DateTimeInterface $createdAt
     * @return $this
     */
    public function setCreatedAt(\DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * @return Conference
     */
    public function getConference(): Conference
    {
        return $this->conference;
    }

    /**
     * @param Conference $conference
     * @return $this
     */
    public function setConference(Conference $conference): self
    {
        $this->conference = $conference;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getPhotoFilename(): ?string
    {
        return $this->photoFilename;
    }

    /**
     * @param string|null $photoFilename
     *
     * @return $this
     */
    public function setPhotoFilename(?string $photoFilename): self
    {
        $this->photoFilename = $photoFilename;

        return $this;
    }
}
