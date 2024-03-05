<?php

namespace App\Entity;

use App\Repository\CategoriesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CategoriesRepository::class)]
class Categories
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\ManyToMany(targetEntity: Fighter::class, mappedBy: 'Category')]
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
            $fighter->addCategory($this);
        }

        return $this;
    }

    public function removeFighter(Fighter $fighter): static
    {
        if ($this->fighters->removeElement($fighter)) {
            $fighter->removeCategory($this);
        }

        return $this;
    }
}
