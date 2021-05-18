<?php

namespace App\Entity;

use App\Repository\RecintosRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=RecintosRepository::class)
 */
class Recintos
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nombre;

    /**
     * @ORM\Column(type="integer")
     */
    private $coste_alquiler;

    /**
     * @ORM\Column(type="integer")
     */
    private $precio_entrada;

    /**
     * @ORM\OneToMany(targetEntity=Conciertos::class, mappedBy="id_recinto")
     */
    private $conciertos;

    public function __construct()
    {
        $this->conciertos = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNombre(): ?string
    {
        return $this->nombre;
    }

    public function setNombre(string $nombre): self
    {
        $this->nombre = $nombre;

        return $this;
    }

    public function getCosteAlquiler(): ?int
    {
        return $this->coste_alquiler;
    }

    public function setCosteAlquiler(int $coste_alquiler): self
    {
        $this->coste_alquiler = $coste_alquiler;

        return $this;
    }

    public function getPrecioEntrada(): ?int
    {
        return $this->precio_entrada;
    }

    public function setPrecioEntrada(int $precio_entrada): self
    {
        $this->precio_entrada = $precio_entrada;

        return $this;
    }

    /**
     * @return Collection|Conciertos[]
     */
    public function getConciertos(): Collection
    {
        return $this->conciertos;
    }

    public function addConcierto(Conciertos $concierto): self
    {
        if (!$this->conciertos->contains($concierto)) {
            $this->conciertos[] = $concierto;
            $concierto->setIdRecinto($this);
        }

        return $this;
    }

    public function removeConcierto(Conciertos $concierto): self
    {
        if ($this->conciertos->removeElement($concierto)) {
            // set the owning side to null (unless already changed)
            if ($concierto->getIdRecinto() === $this) {
                $concierto->setIdRecinto(null);
            }
        }

        return $this;
    }
}
