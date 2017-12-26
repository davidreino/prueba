<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Dapda
 *
 * @ORM\Table(name="dapda")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\DapdaRepository")
 */
class Dapda
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="Nombre", type="string", length=255)
     */
    private $nombre;

    /**
     * @var string
     *
     * @ORM\Column(name="Apellidos", type="string", length=255)
     */
    private $apellidos;

    /**
     * @var string
     *
     * @ORM\Column(name="Telefono", type="string", length=9, nullable=true)
     */
    private $telefono;

    /**
     * @var string
     *
     * @ORM\Column(name="TipoCoche", type="string", length=255)
     */
    private $tipoCoche;

    /**
     * @var string
     *
     * @ORM\Column(name="Preferencia", type="string", length=255)
     */
    private $preferencia;


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set nombre
     *
     * @param string $nombre
     *
     * @return Dapda
     */
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;

        return $this;
    }

    /**
     * Get nombre
     *
     * @return string
     */
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * Set apellidos
     *
     * @param string $apellidos
     *
     * @return Dapda
     */
    public function setApellidos($apellidos)
    {
        $this->apellidos = $apellidos;

        return $this;
    }

    /**
     * Get apellidos
     *
     * @return string
     */
    public function getApellidos()
    {
        return $this->apellidos;
    }

    /**
     * Set telefono
     *
     * @param string $telefono
     *
     * @return Dapda
     */
    public function setTelefono($telefono)
    {
        $this->telefono = $telefono;

        return $this;
    }

    /**
     * Get telefono
     *
     * @return string
     */
    public function getTelefono()
    {
        return $this->telefono;
    }

    /**
     * Set tipoCoche
     *
     * @param string $tipoCoche
     *
     * @return Dapda
     */
    public function setTipoCoche($tipoCoche)
    {
        $this->tipoCoche = $tipoCoche;

        return $this;
    }

    /**
     * Get tipoCoche
     *
     * @return string
     */
    public function getTipoCoche()
    {
        return $this->tipoCoche;
    }

    /**
     * Set preferencia
     *
     * @param string $preferencia
     *
     * @return Dapda
     */
    public function setPreferencia($preferencia)
    {
        $this->preferencia = $preferencia;

        return $this;
    }

    /**
     * Get preferencia
     *
     * @return string
     */
    public function getPreferencia()
    {
        return $this->preferencia;
    }
}

