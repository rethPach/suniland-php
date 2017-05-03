<?php

namespace Suniland\ComunBundle\Entity;

/**
 * TipoEntrada
 */
class TipoEntrada
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $nombre;

    /**
     * @var boolean
     */
    private $activo;

    /**
     * @var \Suniland\ComunBundle\Entity\SucursalParque
     */
    private $idSucursalParque;


    /**
     * Get id
     *
     * @return integer
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
     * @return TipoEntrada
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
     * Set activo
     *
     * @param boolean $activo
     *
     * @return TipoEntrada
     */
    public function setActivo($activo)
    {
        $this->activo = $activo;

        return $this;
    }

    /**
     * Get activo
     *
     * @return boolean
     */
    public function getActivo()
    {
        return $this->activo;
    }

    /**
     * Set idSucursalParque
     *
     * @param \Suniland\ComunBundle\Entity\SucursalParque $idSucursalParque
     *
     * @return TipoEntrada
     */
    public function setIdSucursalParque(\Suniland\ComunBundle\Entity\SucursalParque $idSucursalParque = null)
    {
        $this->idSucursalParque = $idSucursalParque;

        return $this;
    }

    /**
     * Get idSucursalParque
     *
     * @return \Suniland\ComunBundle\Entity\SucursalParque
     */
    public function getIdSucursalParque()
    {
        return $this->idSucursalParque;
    }
}

