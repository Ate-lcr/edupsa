<?php

namespace App\Entity;

use App\Repository\EventRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EventRepository::class)]
class Event
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column()]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $Type = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $Date = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $Notes = null;

    #[ORM\ManyToOne(inversedBy: 'events')]
    #[ORM\JoinColumn(nullable: false)]
    private ?EventCategory $Category = null;

    #[ORM\ManyToMany(targetEntity: Pupil::class, mappedBy: 'Events')]
    private Collection $pupils;

    #[ORM\ManyToMany(targetEntity: Partner::class, mappedBy: 'Event')]
    private Collection $partners;

    public function __construct()
    {
        $this->pupils = new ArrayCollection();
        $this->partners = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getType(): ?string
    {
        return $this->Type;
    }

    public function setType(string $Type): self
    {
        $this->Type = $Type;

        return $this;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->Date;
    }

    public function setDate(\DateTimeInterface $Date): self
    {
        $this->Date = $Date;

        return $this;
    }

    public function getNotes(): ?string
    {
        return $this->Notes;
    }

    public function setNotes(?string $Notes): self
    {
        $this->Notes = $Notes;

        return $this;
    }

    public function getCategory(): ?EventCategory
    {
        return $this->Category;
    }

    public function setCategory(?EventCategory $Category): self
    {
        $this->Category = $Category;

        return $this;
    }

    /**
     * @return Collection<int, Pupil>
     */
    public function getPupils(): Collection
    {
        return $this->pupils;
    }

    public function addPupil(Pupil $pupil): self
    {
        if (!$this->pupils->contains($pupil)) {
            $this->pupils[] = $pupil;
            $pupil->addEvent($this);
        }

        return $this;
    }

    public function removePupil(Pupil $pupil): self
    {
        if ($this->pupils->removeElement($pupil)) {
            $pupil->removeEvent($this);
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
            $partner->addEvent($this);
        }

        return $this;
    }

    public function removePartner(Partner $partner): self
    {
        if ($this->partners->removeElement($partner)) {
            $partner->removeEvent($this);
        }

        return $this;
    }
}
