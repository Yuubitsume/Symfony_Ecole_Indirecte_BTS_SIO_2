<?php

namespace App\Entity;

use App\Repository\ClassesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ClassesRepository::class)]
class Classes
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\OneToMany(mappedBy: 'classe', targetEntity: user::class)]
    private Collection $classe;

    #[ORM\Column(length: 5)]
    private ?string $classe_name = null;

    public function __construct()
    {
        $this->classe = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Collection<int, user>
     */
    public function getClasse(): Collection
    {
        return $this->classe;
    }

    public function addClasse(user $classe): self
    {
        if (!$this->classe->contains($classe)) {
            $this->classe->add($classe);
            $classe->setClasse($this);
        }

        return $this;
    }

    public function removeClasse(user $classe): self
    {
        if ($this->classe->removeElement($classe)) {
            // set the owning side to null (unless already changed)
            if ($classe->getClasse() === $this) {
                $classe->setClasse(null);
            }
        }

        return $this;
    }

    public function getClasseName(): ?string
    {
        return $this->classe_name;
    }

    public function setClasseName(string $classe_name): self
    {
        $this->classe_name = $classe_name;

        return $this;
    }
}
