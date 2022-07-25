<?php

namespace App\Entity;

use App\Repository\PupilRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PupilRepository::class)]
class Pupil
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column()]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $Name = null;

    #[ORM\Column(length: 255)]
    private ?string $Surname = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $BirthDate = null;

    #[ORM\Column(length: 255)]
    private ?string $LegalRepresentative = null;

    #[ORM\Column(length: 255)]
    private ?string $Classroom = null;

    #[ORM\Column]
    private ?int $StreetNb = null;

    #[ORM\Column(length: 255)]
    private ?string $Street = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $AdressComplement = null;

    #[ORM\Column]
    private ?int $PostCode = null;

    #[ORM\Column(length: 255)]
    private ?string $City = null;

    #[ORM\Column(length: 255)]
    private ?string $Email = null;

    #[ORM\Column]
    private ?int $PhoneNb = null;

    #[ORM\ManyToMany(targetEntity: Event::class, inversedBy: 'pupils')]
    private Collection $Events;

    #[ORM\OneToMany(mappedBy: 'pupil', targetEntity: Comment::class)]
    private Collection $Comment;

    #[ORM\ManyToMany(targetEntity: Partner::class, mappedBy: 'Pupil')]
    private Collection $partners;

    public function __construct()
    {
        $this->Events = new ArrayCollection();
        $this->Comment = new ArrayCollection();
        $this->partners = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->Name;
    }

    public function setName(string $Name): self
    {
        $this->Name = $Name;

        return $this;
    }

    public function getSurname(): ?string
    {
        return $this->Surname;
    }

    public function setSurname(string $Surname): self
    {
        $this->Surname = $Surname;

        return $this;
    }

    public function getBirthDate(): ?\DateTimeInterface
    {
        return $this->BirthDate;
    }

    public function setBirthDate(\DateTimeInterface $BirthDate): self
    {
        $this->BirthDate = $BirthDate;

        return $this;
    }

    public function getLegalRepresentative(): ?string
    {
        return $this->LegalRepresentative;
    }

    public function setLegalRepresentative(string $LegalRepresentative): self
    {
        $this->LegalRepresentative = $LegalRepresentative;

        return $this;
    }

    public function getClassroom(): ?string
    {
        return $this->Classroom;
    }

    public function setClassroom(string $Classroom): self
    {
        $this->Classroom = $Classroom;

        return $this;
    }

    public function getStreetNb(): ?int
    {
        return $this->StreetNb;
    }

    public function setStreetNb(int $StreetNb): self
    {
        $this->StreetNb = $StreetNb;

        return $this;
    }

    public function getStreet(): ?string
    {
        return $this->Street;
    }

    public function setStreet(string $Street): self
    {
        $this->Street = $Street;

        return $this;
    }

    public function getAdressComplement(): ?string
    {
        return $this->AdressComplement;
    }

    public function setAdressComplement(?string $AdressComplement): self
    {
        $this->AdressComplement = $AdressComplement;

        return $this;
    }

    public function getPostCode(): ?int
    {
        return $this->PostCode;
    }

    public function setPostCode(int $PostCode): self
    {
        $this->PostCode = $PostCode;

        return $this;
    }

    public function getCity(): ?string
    {
        return $this->City;
    }

    public function setCity(string $City): self
    {
        $this->City = $City;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->Email;
    }

    public function setEmail(string $Email): self
    {
        $this->Email = $Email;

        return $this;
    }

    public function getPhoneNb(): ?int
    {
        return $this->PhoneNb;
    }

    public function setPhoneNb(int $PhoneNb): self
    {
        $this->PhoneNb = $PhoneNb;

        return $this;
    }

    /**
     * @return Collection<int, Event>
     */
    public function getEvents(): Collection
    {
        return $this->Events;
    }

    public function addEvent(Event $event): self
    {
        if (!$this->Events->contains($event)) {
            $this->Events[] = $event;
        }

        return $this;
    }

    public function removeEvent(Event $event): self
    {
        $this->Events->removeElement($event);

        return $this;
    }

    /**
     * @return Collection<int, Comment>
     */
    public function getComment(): Collection
    {
        return $this->Comment;
    }

    public function addComment(Comment $comment): self
    {
        if (!$this->Comment->contains($comment)) {
            $this->Comment[] = $comment;
            $comment->setPupil($this);
        }

        return $this;
    }

    public function removeComment(Comment $comment): self
    {
        if ($this->Comment->removeElement($comment)) {
            // set the owning side to null (unless already changed)
            if ($comment->getPupil() === $this) {
                $comment->setPupil(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Partner>
     */
    public function getPartners(): Collection
    {
        return $this->partners;
    }

    public function addPartner(Partner $partner): self
    {
        if (!$this->partners->contains($partner)) {
            $this->partners[] = $partner;
            $partner->addPupil($this);
        }

        return $this;
    }

    public function removePartner(Partner $partner): self
    {
        if ($this->partners->removeElement($partner)) {
            $partner->removePupil($this);
        }

        return $this;
    }
}
