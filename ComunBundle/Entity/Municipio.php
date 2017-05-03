<?php

namespace Suniland\ComunBundle\Entity;

/**
 * Municipio
 */
class Municipio
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
     * @var \Suniland\ComunBundle\Entity\Estado
     */
    private $estado;


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
     * @return Municipio
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
     * Set estado
     *
     * @param \Suniland\ComunBundle\Entity\Estado $estado
     *
     * @return Municipio
     */
    public function setEstado(\Suniland\ComunBundle\Entity\Estado $estado = null)
    {
        $this->estado = $estado;

        return $this;
    }

    /**
     * Get estado
     *
     * @return \Suniland\ComunBundle\Entity\Estado
     */
    public function getEstado()
    {
        return $this->estado;
    }
}

