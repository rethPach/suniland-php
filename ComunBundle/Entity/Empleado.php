<?php

namespace Suniland\ComunBundle\Entity;

use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\AdvancedUserInterface;
 
class Empleado
{
    protected $id;
 
    protected $nombre;
 
    protected $usuario;

    protected $password;

    protected $activo;

    protected $rol;


 

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
     * @return Empleado
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
     * Set usuario
     *
     * @param string $usuario
     *
     * @return Empleado
     */
    public function setUsuario($usuario)
    {
        $this->usuario = $usuario;

        return $this;
    }

    /**
     * Get usuario
     *
     * @return string
     */
    public function getUsuario()
    {
        return $this->usuario;
    }

    /**
     * Set password
     *
     * @param string $password
     *
     * @return Empleado
     */
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Get password
     *
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Set activo
     *
     * @param boolean $activo
     *
     * @return Empleado
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
     * Set rol
     *
     * @param \Suniland\ComunBundle\Entity\Rol $rol
     *
     * @return Empleado
     */
    public function setRol(\Suniland\ComunBundle\Entity\Rol $rol = null)
    {
        $this->rol = $rol;

        return $this;
    }

    /**
     * Get rol
     *
     * @return \Suniland\ComunBundle\Entity\Rol
     */
    public function getRol()
    {
        return $this->rol;
    }
}
