<?php

namespace App\Entity;

use App\Repository\CommentRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CommentRepository::class)]
class Comment
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column()]
    private ?int $id = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $Description = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $Date_comment = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $ByUser = null;

    #[ORM\ManyToOne(inversedBy: 'Comment')]
    private ?Pupil $pupil = null;

    public function getId(): ?int
    {
        return $this->id;
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

    public function getDateComment(): ?\DateTimeInterface
    {
        return $this->Date_comment;
    }

    public function setDateComment(\DateTimeInterface $Date_comment): self
    {
        $this->Date_comment = $Date_comment;

        return $this;
    }

    public function getByUser(): ?User
    {
        return $this->ByUser;
    }

    public function setByUser(?User $ByUser): self
    {
        $this->ByUser = $ByUser;

        return $this;
    }

    public function getPupil(): ?Pupil
    {
        return $this->pupil;
    }

    public function setPupil(?Pupil $pupil): self
    {
        $this->pupil = $pupil;

        return $this;
    }
}
