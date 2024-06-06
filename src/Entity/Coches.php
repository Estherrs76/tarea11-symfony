<?php

namespace App\Entity;

use App\Repository\CochesRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CochesRepository::class)]
class Coches
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $modelo = null;

    #[ORM\Column]
    private ?int $potencia = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 7, scale: 2)]
    private ?string $precio = null;

    #[ORM\Column]
    private ?bool $stock = null;

    #[ORM\ManyToOne(inversedBy: 'coches')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Tipos $id_tipo = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getModelo(): ?string
    {
        return $this->modelo;
    }

    public function setModelo(string $modelo): static
    {
        $this->modelo = $modelo;

        return $this;
    }

    public function getPotencia(): ?int
    {
        return $this->potencia;
    }

    public function setPotencia(int $potencia): static
    {
        $this->potencia = $potencia;

        return $this;
    }

    public function getPrecio(): ?string
    {
        return $this->precio;
    }

    public function setPrecio(string $precio): static
    {
        $this->precio = $precio;

        return $this;
    }

    public function isStock(): ?bool
    {
        return $this->stock;
    }

    public function setStock(bool $stock): static
    {
        $this->stock = $stock;

        return $this;
    }

    public function getIdTipo(): ?Tipos
    {
        return $this->id_tipo;
    }

    public function setIdTipo(?Tipos $id_tipo): static
    {
        $this->id_tipo = $id_tipo;

        return $this;
    }
}
