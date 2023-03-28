<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Destinos
 *
 * @ORM\Table(name="destinos")
 * @ORM\Entity
 * @ORM\Entity(repositoryClass="App\Repository\DestinosRepository")
 */
class Destinos
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_destinos", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="destinos_id_destinos_seq", allocationSize=1, initialValue=1)
     */
    private $idDestinos;

    /**
     * @var array|null
     *
     * @ORM\Column(name="destinos", type="json", nullable=true)
     */
    private $destinos;

    /**
     * @var string|null
     *
     * @ORM\Column(name="estado", type="string", length=1, nullable=true)
     */
    private $estado;

    public function getIdDestinos(): ?int
    {
        return $this->idDestinos;
    }

    public function getDestinos(): array
    {
        return $this->destinos;
    }

    public function setDestinos(?array $destinos): self
    {
        $this->destinos = $destinos;

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


}
