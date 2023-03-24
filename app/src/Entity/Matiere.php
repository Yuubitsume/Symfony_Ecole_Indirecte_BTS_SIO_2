<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\MatiereRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MatiereRepository::class)]
#[ApiResource]
class Matiere
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\OneToMany(mappedBy: 'matiere', targetEntity: NoteControle::class)]
    private Collection $noteControles;

    #[ORM\Column(length: 40)]
    private ?string $libelle = null;

    public function __construct()
    {
        $this->noteControles = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Collection<int, NoteControle>
     */
    public function getNoteControles(): Collection
    {
        return $this->noteControles;
    }

    public function addNoteControle(NoteControle $noteControle): self
    {
        if (!$this->noteControles->contains($noteControle)) {
            $this->noteControles->add($noteControle);
            $noteControle->setMatiere($this);
        }

        return $this;
    }

    public function removeNoteControle(NoteControle $noteControle): self
    {
        if ($this->noteControles->removeElement($noteControle)) {
            // set the owning side to null (unless already changed)
            if ($noteControle->getMatiere() === $this) {
                $noteControle->setMatiere(null);
            }
        }

        return $this;
    }

    public function getLibelle(): ?string
    {
        return $this->libelle;
    }

    public function setLibelle(string $libelle): self
    {
        $this->libelle = $libelle;

        return $this;
    }
}
