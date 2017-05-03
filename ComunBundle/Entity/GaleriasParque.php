<?php

namespace Suniland\ComunBundle\Entity;

/**
 * GaleriasParque
 */
class GaleriasParque
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $titulo;

    /**
     * @var string
     */
    private $imagen;

    /**
     * @var boolean
     */
    private $activa;

    /**
     * @var \Suniland\ComunBundle\Entity\TipoEntrada
     */
    private $idTipoEntrada;

    protected $sucursalParque;

    public function getSucursalParque()
    {
        return $this->sucursalParque;
    }

    public function setSucursalParque(SucursalParque $sucursalParque)
    {
        $this->sucursalParque = $sucursalParque;
    }


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
     * Set titulo
     *
     * @param string $titulo
     *
     * @return GaleriasParque
     */
    public function setTitulo($titulo)
    {
        $this->titulo = $titulo;

        return $this;
    }

    /**
     * Get titulo
     *
     * @return string
     */
    public function getTitulo()
    {
        return $this->titulo;
    }

    /**
     * Set imagen
     *
     * @param string $imagen
     *
     * @return GaleriasParque
     */
    public function setImagen($imagen)
    {
        $this->imagen = $imagen;

        return $this;
    }

    /**
     * Get imagen
     *
     * @return string
     */
    public function getImagen()
    {
        return $this->imagen;
    }

    /**
     * Set activa
     *
     * @param boolean $activa
     *
     * @return GaleriasParque
     */
    public function setActiva($activa)
    {
        $this->activa = $activa;

        return $this;
    }

    /**
     * Get activa
     *
     * @return boolean
     */
    public function getActiva()
    {
        return $this->activa;
    }

    /**
     * Set idTipoEntrada
     *
     * @param \Suniland\ComunBundle\Entity\TipoEntrada $idTipoEntrada
     *
     * @return GaleriasParque
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

