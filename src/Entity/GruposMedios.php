<?php

namespace App\Entity;

use App\Repository\GruposMediosRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=GruposMediosRepository::class)
 */
class GruposMedios
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;
    
    
    /**
     * @ORM\ManyToOne(targetEntity=Medios::class, inversedBy="gruposMedios")
     * @ORM\JoinColumn(nullable=false)
     */
    private $id_medio;

    /**
     * @ORM\ManyToOne(targetEntity=Conciertos::class, inversedBy="gruposMedios")
     * @ORM\JoinColumn(nullable=false)
     */
    private $id_concierto;




    public function getId(): ?int
    {
        return $this->id;
    }
    

    public function getIdMedio(): ?Medios
    {
        return $this->id_medio;
    }

    public function setIdMedio(?Medios $id_medio): self
    {
        $this->id_medio = $id_medio;

        return $this;
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



}
