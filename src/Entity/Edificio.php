<?php

namespace App\Entity;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

/**
 * Edificio
 *
 * @ORM\Table(name="edificio", indexes={@ORM\Index(name="IDX_DED4A4E8EC0EE4EE", columns={"id_asesor"})})
 * @ORM\Entity
 * @ORM\Entity(repositoryClass="App\Repository\EdificioRepository")
 */
class Edificio
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_edificio", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="edificio_id_edificio_seq", allocationSize=1, initialValue=1)
     */
    private $idEdificio;

    /**
     * @var string
     *
     * @ORM\Column(name="descripcion", type="string", length=200, nullable=false)
     */
    private $descripcion;

    /**
     * @var string
     *
     * @ORM\Column(name="condicion", type="string", length=50, nullable=false)
     */
    private $condicion;

    /**
     * @var string
     *
     * @ORM\Column(name="costo", type="decimal", precision=6, scale=0, nullable=false)
     */
    private $costo;

    /**
     * @var string|null
     *
     * @ORM\Column(name="estado", type="string", length=1, nullable=true)
     */
    private $estado;

    /**
     * @var \App\Entity\Usuario
     *
     * @ORM\ManyToOne(targetEntity="Usuario")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_asesor", referencedColumnName="id_usuario")
     * })
     */
    private $idAsesor;

    public function getIdEdificio(): ?int
    {
        return $this->idEdificio;
    }

    public function getDescripcion(): ?string
    {
        return $this->descripcion;
    }

    public function setDescripcion(string $descripcion): self
    {
        $this->descripcion = $descripcion;

        return $this;
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

    public function getCosto(): ?string
    {
        return $this->costo;
    }

    public function setCosto(string $costo): self
    {
        $this->costo = $costo;

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

    public function getIdAsesor(): ?Usuario
    {
        return $this->idAsesor;
    }

    public function setIdAsesor(?Usuario $idAsesor): self
    {
        $this->idAsesor = $idAsesor;

        return $this;
    }


}
