<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Ruta
 *
 * @ORM\Table(name="ruta", indexes={@ORM\Index(name="IDX_C3AEF08C3CFFF9E6", columns={"id_repartidor"})})
 * @ORM\Entity
 * @ORM\Entity(repositoryClass="App\Repository\RutaRepository")
 */
class Ruta
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_ruta", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="ruta_id_ruta_seq", allocationSize=1, initialValue=1)
     */
    private $idRuta;

    /**
     * @var array
     *
     * @ORM\Column(name="paquetes", type="json", nullable=false)
     */
    private $paquetes;

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
     * @var \App\Entity\Usuario
     *
     * @ORM\ManyToOne(targetEntity="Usuario")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_repartidor", referencedColumnName="id_usuario")
     * })
     */
    private $idRepartidor;

    public function getIdRuta(): ?int
    {
        return $this->idRuta;
    }

    public function getPaquetes(): array
    {
        return $this->paquetes;
    }

    public function setPaquetes(array $paquetes): self
    {
        $this->paquetes = $paquetes;

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

    public function getEstado(): ?string
    {
        return $this->estado;
    }

    public function setEstado(?string $estado): self
    {
        $this->estado = $estado;

        return $this;
    }

    public function getIdRepartidor(): ?Usuario
    {
        return $this->idRepartidor;
    }

    public function setIdRepartidor(?Usuario $idRepartidor): self
    {
        $this->idRepartidor = $idRepartidor;

        return $this;
    }


}
