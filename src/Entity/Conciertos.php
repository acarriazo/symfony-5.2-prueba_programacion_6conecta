<?php

namespace App\Entity;

use App\Repository\ConciertosRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ConciertosRepository::class)
 */
class Conciertos
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
    private $numero_espectadores;

    /**
     * @ORM\Column(type="date")
     */
    private $fecha;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $rentabilidad;

    /**
     * @ORM\OneToMany(targetEntity=GruposConciertos::class, mappedBy="id_concierto")
     */
    private $gruposConciertos;

    /**
     * @ORM\OneToMany(targetEntity=GruposMedios::class, mappedBy="id_concierto")
     */
    private $gruposMedios;

    /**
     * @ORM\ManyToOne(targetEntity=Promotores::class, inversedBy="conciertos")
     * @ORM\JoinColumn(nullable=false)
     */
    private $id_promotor;

    /**
     * @ORM\ManyToOne(targetEntity=Recintos::class, inversedBy="conciertos")
     * @ORM\JoinColumn(nullable=false)
     */
    private $id_recinto;

    public function __construct()
    {
        $this->gruposConciertos = new ArrayCollection();
        $this->gruposMedios = new ArrayCollection();
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

    public function getNumeroEspectadores(): ?int
    {
        return $this->numero_espectadores;
    }

    public function setNumeroEspectadores(int $numero_espectadores): self
    {
        $this->numero_espectadores = $numero_espectadores;

        return $this;
    }

    public function getFecha(): ?\DateTimeInterface
    {
        return $this->fecha;
    }

    public function setFecha(\DateTimeInterface $fecha): self
    {
        $this->fecha = $fecha;

        return $this;
    }

    public function getRentabilidad(): ?int
    {
        return $this->rentabilidad;
    }

    public function setRentabilidad(int $rentabilidad): self
    {
        $this->rentabilidad = $rentabilidad;

        return $this;
    }

    /**
     * @return Collection|GruposConciertos[]
     */
    public function getGruposConciertos(): Collection
    {
        return $this->gruposConciertos;
    }

    public function addGruposConcierto(GruposConciertos $gruposConcierto): self
    {
        if (!$this->gruposConciertos->contains($gruposConcierto)) {
            $this->gruposConciertos[] = $gruposConcierto;
            $gruposConcierto->setIdConcierto($this);
        }

        return $this;
    }

    public function removeGruposConcierto(GruposConciertos $gruposConcierto): self
    {
        if ($this->gruposConciertos->removeElement($gruposConcierto)) {
            // set the owning side to null (unless already changed)
            if ($gruposConcierto->getIdConcierto() === $this) {
                $gruposConcierto->setIdConcierto(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|GruposMedios[]
     */
    public function getGruposMedios(): Collection
    {
        return $this->gruposMedios;
    }

    public function addGruposMedio(GruposMedios $gruposMedio): self
    {
        if (!$this->gruposMedios->contains($gruposMedio)) {
            $this->gruposMedios[] = $gruposMedio;
            $gruposMedio->setIdMedio($this);
        }

        return $this;
    }

    public function removeGruposMedio(GruposMedios $gruposMedio): self
    {
        if ($this->gruposMedios->removeElement($gruposMedio)) {
            // set the owning side to null (unless already changed)
            if ($gruposMedio->getIdMedio() === $this) {
                $gruposMedio->setIdMedio(null);
            }
        }

        return $this;
    }

    public function getIdPromotor(): ?Promotores
    {
        return $this->id_promotor;
    }

    public function setIdPromotor(?Promotores $id_promotor): self
    {
        $this->id_promotor = $id_promotor;

        return $this;
    }

    public function getIdRecinto(): ?Recintos
    {
        return $this->id_recinto;
    }

    public function setIdRecinto(?Recintos $id_recinto): self
    {
        $this->id_recinto = $id_recinto;

        return $this;
    }

    

}
