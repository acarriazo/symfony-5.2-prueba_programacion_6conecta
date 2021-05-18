<?php

namespace App\Entity;

use App\Repository\GruposConciertosRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=GruposConciertosRepository::class)
 */
class GruposConciertos
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;


    /**
     * @ORM\ManyToOne(targetEntity=Conciertos::class, inversedBy="gruposConciertos")
     * @ORM\JoinColumn(nullable=false)
     */
    private $id_concierto;

    /**
     * @ORM\ManyToOne(targetEntity=Grupos::class, inversedBy="gruposConciertos")
     * @ORM\JoinColumn(nullable=false)
     */
    private $id_grupo;

    

    public function getId(): ?int
    {
        return $this->id;
    }



    public function getIdConcierto(): ?Conciertos
    {
        return $this->id_concierto;
    }

    public function setIdConcierto(?Conciertos $id_concierto): self
    {
        $this->id_concierto = $id_concierto;

        return $this;
    }

    public function getIdGrupo(): ?Grupos
    {
        return $this->id_grupo;
    }

    public function setIdGrupo(?Grupos $id_grupo): self
    {
        $this->id_grupo = $id_grupo;

        return $this;
    }




}
