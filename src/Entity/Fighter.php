<?php

namespace App\Entity;


use App\Repository\FighterRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: FighterRepository::class)]
class Fighter implements \JsonSerializable
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(length: 255)]
    private ?string $surname = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $pseudonym = null;

    #[ORM\Column]
    private ?int $age = null;

    #[ORM\Column]
    private ?float $weight = null;

    #[ORM\Column]
    private ?float $height = null;

    #[ORM\Column]
    private ?float $reach = null;

    #[ORM\Column(length: 255)]
    private ?string $stance = null;

    #[ORM\ManyToOne(inversedBy: 'fighters')]
    private ?Organisation $organisation = null;

    #[ORM\ManyToMany(targetEntity: Categories::class, inversedBy: 'fighters')]
    private Collection $Category;

    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(nullable: false)]
    private ?score $resume = null;

    public function __construct()
    {
        $this->Category = new ArrayCollection();
    }

    public function jsonSerialize(){
        return [
            'name' => $this->name,
            'surname' => $this->surname,
            'pseudonym' => $this->pseudonym,
            'age' => $this->age,
            'weight' => $this->weight,
            'height' => $this->height,
            'reach' => $this->reach,
            'stance' => $this->stance,
            'organisation' => $this->organisation->getName(),
            'category' => $this->Category->getKeys("fighters"),
            'resume' => $this->resume->getResume()
        ];
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

    public function getSurname(): ?string
    {
        return $this->surname;
    }

    public function setSurname(string $surname): static
    {
        $this->surname = $surname;

        return $this;
    }

    public function getPseudonym(): ?string
    {
        return $this->pseudonym;
    }

    public function setPseudonym(?string $pseudonym): static
    {
        $this->pseudonym = $pseudonym;

        return $this;
    }

    public function getAge(): ?int
    {
        return $this->age;
    }

    public function setAge(int $age): static
    {
        $this->age = $age;

        return $this;
    }

    public function getWeight(): ?float
    {
        return $this->weight;
    }

    public function setWeight(float $weight): static
    {
        $this->weight = $weight;

        return $this;
    }

    public function getHeight(): ?float
    {
        return $this->height;
    }

    public function setHeight(float $height): static
    {
        $this->height = $height;

        return $this;
    }

    public function getReach(): ?float
    {
        return $this->reach;
    }

    public function setReach(float $reach): static
    {
        $this->reach = $reach;

        return $this;
    }

    public function getStance(): ?string
    {
        return $this->stance;
    }

    public function setStance(string $stance): static
    {
        $this->stance = $stance;

        return $this;
    }

    public function getOrganisation(): ?Organisation
    {
        return $this->organisation;
    }

    public function setOrganisation(?Organisation $organisation): static
    {
        $this->organisation = $organisation;

        return $this;
    }

    /**
     * @return Collection<int, Categories>
     */
    public function getCategory(): Collection
    {
        return $this->Category;
    }

    public function addCategory(Categories $category): static
    {
        if (!$this->Category->contains($category)) {
            $this->Category->add($category);
        }

        return $this;
    }

    public function removeCategory(Categories $category): static
    {
        $this->Category->removeElement($category);

        return $this;
    }

    public function getResume(): ?score
    {
        return $this->resume;
    }

    public function setResume(score $resume): static
    {
        $this->resume = $resume;

        return $this;
    }
}
