<?php
namespace Suniland\ComunBundle\TransferObjects;


class BuscadorCriteria
{
    protected $boletoId;
    protected $boletoNombre;
    protected $sucursalId;
    protected $sucursalNombre;
    protected $usuarioId;
    protected $usuarioNombre;
    protected $usuarioApellido;
    protected $rangoFrom;
    protected $rangoTo;

    public function __construct()
    {

    }

    public function getBoletoId()
    {
        return $this->boletoId;
    }

    public function getBoletoNombre()
    {
        return $this->boletoNombre;
    }

    public function getSucursalId()
    {
        return $this->sucursalId;
    }

    public function getSucursalNombre()
    {
        return $this->sucursalNombre;
    }

    public function getUsuarioId()
    {
        return $this->usuarioId;
    }

    public function getUsuarioNombre()
    {
        return $this->usuarioNombre;
    }

    public function getUsuarioApellido()
    {
        return $this->usuarioApellido;
    }

    public function getRangoFrom()
    {
        return $this->rangoFrom;
    }

    public function getRangoTo()
    {
        return $this->rangoTo;
    }

    public function setBoletoId($boletoId)
    {
        $this->boletoId = $boletoId;
        return $this;
    }

    public function setBoletoNombre($boletoNombre)
    {
        $this->boletoNombre = $boletoNombre;
        return $this;
    }

    public function setSucursalId($sucursalId)
    {
        $this->sucursalId = $sucursalId;
        return $this;
    }

    public function setSucursalNombre($sucursalNombre)
    {
        $this->sucursalNombre = $sucursalNombre;
        return $this;
    }

    public function setUsuarioId($usuarioId)
    {
        $this->usuarioId = $usuarioId;
        return $this;
    }

    public function setUsuarioNombre($usuarioNombre)
    {
        $this->usuarioNombre = $usuarioNombre;
        return $this;
    }

    public function setUsuarioApellido($usuarioApellido)
    {
        $this->usuarioApellido = $usuarioApellido;
        return $this;
    }

    public function setRangoFrom($rangoFrom)
    {
        $this->rangoFrom = $rangoFrom;
        return $this;
    }

    public function setRangoTo($rangoTo)
    {
        $this->rangoTo = $rangoTo;
        return $this;
    }
}