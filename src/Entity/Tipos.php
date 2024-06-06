<?php

namespace App\Entity;

use App\Repository\TiposRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TiposRepository::class)]
class Tipos
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nombre = null;

    /**
     * @var Collection<int, Coches>
     */
    #[ORM\OneToMany(targetEntity: Coches::class, mappedBy: 'id_tipo')]
    private Collection $coches;

    public function __construct()
    {
        $this->coches = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNombre(): ?string
    {
        return $this->nombre;
    }

    public function setNombre(string $nombre): static
    {
        $this->nombre = $nombre;

        return $this;
    }

    /**
     * @return Collection<int, Coches>
     */
    public function getCoches(): Collection
    {
        return $this->coches;
    }

    public function addCoch(Coches $coch): static
    {
        if (!$this->coches->contains($coch)) {
            $this->coches->add($coch);
            $coch->setIdTipo($this);
        }

        return $this;
    }

    public function removeCoch(Coches $coch): static
    {
        if ($this->coches->removeElement($coch)) {
            // set the owning side to null (unless already changed)
            if ($coch->getIdTipo() === $this) {
                $coch->setIdTipo(null);
            }
        }

        return $this;
    }
}
