<?php

namespace App\Entity;

use App\Repository\PartnerRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PartnerRepository::class)]
class Partner
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column()]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $Name = null;

    #[ORM\Column(length: 255)]
    private ?string $Surname = null;

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

    #[ORM\ManyToMany(targetEntity: Pupil::class, inversedBy: 'partners')]
    private Collection $Pupil;

    #[ORM\ManyToMany(targetEntity: Event::class, inversedBy: 'partners')]
    private Collection $Event;

    public function __construct()
    {
        $this->Pupil = new ArrayCollection();
        $this->Event = new ArrayCollection();
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
     * @return Collection<int, Pupil>
     */
    public function getPupil(): Collection
    {
        return $this->Pupil;
    }

    public function addPupil(Pupil $pupil): self
    {
        if (!$this->Pupil->contains($pupil)) {
            $this->Pupil[] = $pupil;
        }

        return $this;
    }

    public function removePupil(Pupil $pupil): self
    {
        $this->Pupil->removeElement($pupil);

        return $this;
    }

    /**
     * @return Collection<int, Event>
     */
    public function getEvent(): Collection
    {
        return $this->Event;
    }

    public function addEvent(Event $event): self
    {
        if (!$this->Event->contains($event)) {
            $this->Event[] = $event;
        }

        return $this;
    }

    public function removeEvent(Event $event): self
    {
        $this->Event->removeElement($event);

        return $this;
    }
}
