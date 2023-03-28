<?php

namespace App\Entity;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

/**
 * Paquete
 *
 * @ORM\Table(name="paquete", indexes={@ORM\Index(name="IDX_12686A95488EEC8E", columns={"id_ruta"})})
 * @ORM\Entity
 * @ORM\Entity(repositoryClass="App\Repository\PaqueteRepository")
 */
class Paquete
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_paquete", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="paquete_id_paquete_seq", allocationSize=1, initialValue=1)
     */
    private $idPaquete;

    /**
     * @var string
     *
     * @ORM\Column(name="peso", type="decimal", precision=2, scale=1, nullable=false)
     */
    private $peso;

    /**
     * @var string|null
     *
     * @ORM\Column(name="destino", type="string", length=100, nullable=true)
     */
    private $destino;

    /**
     * @var int|null
     *
     * @ORM\Column(name="emisor", type="integer", nullable=true)
     */
    private $emisor;

    /**
     * @var int|null
     *
     * @ORM\Column(name="receptor", type="integer", nullable=true)
     */
    private $receptor;

    /**
     * @var string|null
     *
     * @ORM\Column(name="tipo", type="string", length=50, nullable=true)
     */
    private $tipo;

    /**
     * @var string|null
     *
     * @ORM\Column(name="condicion", type="string", length=50, nullable=true)
     */
    private $condicion;

    /**
     * @var string|null
     *
     * @ORM\Column(name="estado", type="string", length=1, nullable=true)
     */
    private $estado;

    /**
     * @var \App\Entity\Ruta
     *
     * @ORM\ManyToOne(targetEntity="Ruta")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_ruta", referencedColumnName="id_ruta")
     * })
     */
    private $idRuta;

    public function getIdPaquete(): ?int
    {
        return $this->idPaquete;
    }

    public function getPeso(): ?string
    {
        return $this->peso;
    }

    public function setPeso(string $peso): self
    {
        $this->peso = $peso;

        return $this;
    }

    public function getDestino(): ?string
    {
        return $this->destino;
    }

    public function setDestino(?string $destino): self
    {
        $this->destino = $destino;

        return $this;
    }

    public function getEmisor(): ?int
    {
        return $this->emisor;
    }

    public function setEmisor(?int $emisor): self
    {
        $this->emisor = $emisor;

        return $this;
    }

    public function getReceptor(): ?int
    {
        return $this->receptor;
    }

    public function setReceptor(?int $receptor): self
    {
        $this->receptor = $receptor;

        return $this;
    }

    public function getTipo(): ?string
    {
        return $this->tipo;
    }

    public function setTipo(?string $tipo): self
    {
        $this->tipo = $tipo;

        return $this;
    }

    public function getCondicion(): ?string
    {
        return $this->condicion;
    }

    public function setCondicion(?string $condicion): self
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

    public function getIdRuta(): ?Ruta
    {
        return $this->idRuta;
    }

    public function setIdRuta(?Ruta $idRuta): self
    {
        $this->idRuta = $idRuta;

        return $this;
    }


}
