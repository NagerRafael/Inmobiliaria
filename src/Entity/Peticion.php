<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Peticion
 *
 * @ORM\Table(name="peticion", indexes={@ORM\Index(name="IDX_3297E4258E0F487D", columns={"id_edificio"}), @ORM\Index(name="IDX_3297E425FCF8192D", columns={"id_usuario"})})
 * @ORM\Entity
 * @ORM\Entity(repositoryClass="App\Repository\PeticionRepository")
 */
class Peticion
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_peticion", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="peticion_id_peticion_seq", allocationSize=1, initialValue=1)
     */
    private $idPeticion;

    /**
     * @var string
     *
     * @ORM\Column(name="condicion", type="string", length=50, nullable=false)
     */
    private $condicion;

    /**
     * @var string|null
     *
     * @ORM\Column(name="estado", type="string", length=1, nullable=true)
     */
    private $estado;

    /**
     * @var \App\Entity\Edificio
     *
     * @ORM\ManyToOne(targetEntity="Edificio")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_edificio", referencedColumnName="id_edificio")
     * })
     */
    private $idEdificio;

    /**
     * @var \App\Entity\Usuario
     *
     * @ORM\ManyToOne(targetEntity="Usuario")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_usuario", referencedColumnName="id_usuario")
     * })
     */
    private $idUsuario;

    public function getIdPeticion(): ?int
    {
        return $this->idPeticion;
    }

    public function getCondicion(): ?string
    {
        return $this->condicion;
    }

    public function setCondicion(string $condicion): self
    {
        $this->condicion = $condicion;

        return $this;
    }

    public function getEstado(): ?string
    {
        return $this->estado;
    }

    public function setEstado(?string $estado): self
    {
        $this->estado = $estado;

        return $this;
    }

    public function getIdEdificio(): ?Edificio
    {
        return $this->idEdificio;
    }

    public function setIdEdificio(?Edificio $idEdificio): self
    {
        $this->idEdificio = $idEdificio;

        return $this;
    }

    public function getIdUsuario(): ?Usuario
    {
        return $this->idUsuario;
    }

    public function setIdUsuario(?Usuario $idUsuario): self
    {
        $this->idUsuario = $idUsuario;

        return $this;
    }


}
