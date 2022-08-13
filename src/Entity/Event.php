<?php

declare(strict_types=1);

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
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $event_starts_at = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $event_ends_at = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $registration_starts_at = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $registration_ends_at = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $description = null;

    #[ORM\OneToMany(mappedBy: 'event', targetEntity: Talk::class, orphanRemoval: true)]
    private Collection $talks;

    public function __construct()
    {
        $this->talks = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getEventStartsAt(): ?\DateTimeImmutable
    {
        return $this->event_starts_at;
    }

    public function setEventStartsAt(\DateTimeImmutable $event_starts_at): self
    {
        $this->event_starts_at = $event_starts_at;

        return $this;
    }

    public function getEventEndsAt(): ?\DateTimeImmutable
    {
        return $this->event_ends_at;
    }

    public function setEventEndsAt(\DateTimeImmutable $event_ends_at): self
    {
        $this->event_ends_at = $event_ends_at;

        return $this;
    }

    public function getRegistrationStartsAt(): ?\DateTimeImmutable
    {
        return $this->registration_starts_at;
    }

    public function setRegistrationStartsAt(\DateTimeImmutable $registration_starts_at): self
    {
        $this->registration_starts_at = $registration_starts_at;

        return $this;
    }

    public function getRegistrationEndsAt(): ?\DateTimeImmutable
    {
        return $this->registration_ends_at;
    }

    public function setRegistrationEndsAt(\DateTimeImmutable $registration_ends_at): self
    {
        $this->registration_ends_at = $registration_ends_at;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @return Collection<int, Talk>
     */
    public function getTalks(): Collection
    {
        return $this->talks;
    }

    public function addTalk(Talk $talk): self
    {
        if (! $this->talks->contains($talk)) {
            $this->talks->add($talk);
            $talk->setEvent($this);
        }

        return $this;
    }

    public function removeTalk(Talk $talk): self
    {
        if ($this->talks->removeElement($talk)) {
            // set the owning side to null (unless already changed)
            if ($talk->getEvent() === $this) {
                $talk->setEvent(null);
            }
        }

        return $this;
    }
}
