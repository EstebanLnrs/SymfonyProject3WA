<?php

namespace App\Entity;

use App\Repository\OrganisationRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: OrganisationRepository::class)]
class Organisation
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\OneToMany(targetEntity: Fighter::class, mappedBy: 'organisation')]
    private Collection $fighters;

    public function __construct()
    {
        $this->fighters = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return Collection<int, Fighter>
     */
    public function getFighters(): Collection
    {
        return $this->fighters;
    }

    public function addFighter(Fighter $fighter): static
    {
        if (!$this->fighters->contains($fighter)) {
            $this->fighters->add($fighter);
            $fighter->setOrganisation($this);
        }

        return $this;
    }

    public function removeFighter(Fighter $fighter): static
    {
        if ($this->fighters->removeElement($fighter)) {
            // set the owning side to null (unless already changed)
            if ($fighter->getOrganisation() === $this) {
                $fighter->setOrganisation(null);
            }
        }

        return $this;
    }
}
