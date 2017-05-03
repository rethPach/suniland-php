<?php

namespace Suniland\ComunBundle\Entity;
 
class Rol
{
    protected $id;
 
    protected $nombre;

    protected $activo;

    
    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $empleado;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->empleado = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set nombre
     *
     * @param string $nombre
     *
     * @return Rol
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
     * @return Rol
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
     * Add empleado
     *
     * @param \Suniland\ComunBundle\Entity\Empleado $empleado
     *
     * @return Rol
     */
    public function addEmpleado(\Suniland\ComunBundle\Entity\Empleado $empleado)
    {
        $this->empleado[] = $empleado;

        return $this;
    }

    /**
     * Remove empleado
     *
     * @param \Suniland\ComunBundle\Entity\Empleado $empleado
     */
    public function removeEmpleado(\Suniland\ComunBundle\Entity\Empleado $empleado)
    {
        $this->empleado->removeElement($empleado);
    }

    /**
     * Get empleado
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getEmpleado()
    {
        return $this->empleado;
    }
}
