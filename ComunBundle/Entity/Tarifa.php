<?php

namespace Suniland\ComunBundle\Entity;

/**
 * Tarifa
 */
class Tarifa
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $monto;

    /**
     * @var boolean
     */
    private $activo;

    /**
     * @var \Suniland\ComunBundle\Entity\TipoEntrada
     */
    private $idTipoEntrada;


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
     * Set monto
     *
     * @param string $monto
     *
     * @return Tarifa
     */
    public function setMonto($monto)
    {
        $this->monto = $monto;

        return $this;
    }

    /**
     * Get monto
     *
     * @return string
     */
    public function getMonto()
    {
        return $this->monto;
    }

    /**
     * Set activo
     *
     * @param boolean $activo
     *
     * @return Tarifa
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
     * Set idTipoEntrada
     *
     * @param \Suniland\ComunBundle\Entity\TipoEntrada $idTipoEntrada
     *
     * @return Tarifa
     */
    public function setIdTipoEntrada(\Suniland\ComunBundle\Entity\TipoEntrada $idTipoEntrada = null)
    {
        $this->idTipoEntrada = $idTipoEntrada;

        return $this;
    }

    /**
     * Get idTipoEntrada
     *
     * @return \Suniland\ComunBundle\Entity\TipoEntrada
     */
    public function getIdTipoEntrada()
    {
        return $this->idTipoEntrada;
    }
}

