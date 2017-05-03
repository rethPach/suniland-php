<?php

namespace Suniland\ComunBundle\Entity;

class SucursalParque
{

    private $id;
    private $nombre;
    private $direccion;
    private $telefono;
    private $telefonoAlternativo;
    private $activo;
    private $nombre_carpeta;
    private $idParque;
    private $boletoInventario;


    public function setBoletoInventario(BoletoInventario $boletoInventario)
    {
        $this->boletoInventario = $boletoInventario;
    }

    public function setMockId($mockId)
    {
        return $mockId;
    }

    public function boletoInventario()
    {
        return $this->boletoInventario;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setNombre($nombre)
    {
        $this->nombre = $nombre;

        return $this;
    }

    public function getNombre()
    {
        return $this->nombre;
    }

    public function setDireccion($direccion)
    {
        $this->direccion = $direccion;

        return $this;
    }

    public function getDireccion()
    {
        return $this->direccion;
    }

    public function setTelefono($telefono)
    {
        $this->telefono = $telefono;

        return $this;
    }

    public function getTelefono()
    {
        return $this->telefono;
    }

    public function setTelefonoAlternativo($telefonoAlternativo)
    {
        $this->telefonoAlternativo = $telefonoAlternativo;

        return $this;
    }

    public function getTelefonoAlternativo()
    {
        return $this->telefonoAlternativo;
    }

    public function setActivo($activo)
    {
        $this->activo = $activo;

        return $this;
    }

    public function getActivo()
    {
        return $this->activo;
    }

    public function setNombreCarpeta($nombreCarpeta)
    {
        $this->nombre_carpeta = $nombreCarpeta;

        return $this;
    }

    public function getNombreCarpeta()
    {
        return $this->nombre_carpeta;
    }

    public function setIdParque(\Suniland\ComunBundle\Entity\Parque $idParque = null)
    {
        $this->idParque = $idParque;

        return $this;
    }

    public function getIdParque()
    {
        return $this->idParque;
    }
}

