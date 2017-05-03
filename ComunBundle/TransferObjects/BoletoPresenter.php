<?php
/**
 * Created by PhpStorm.
 * User: NPACHECO
 * Date: 16/02/2017
 * Time: 05:13 PM
 */

namespace Suniland\ComunBundle\TransferObjects;

use Suniland\ComunBundle\Entity\Pay;

class BoletoPresenter
{
    public function __construct(Pay $pago)
    {
        $this->pago = $pago;
    }

    public function getId()
    {
        return $this->pago->getId();
    }

    public function getClienteCedula()
    {
        return $this->pago->getUsuario()->getCedula();
    }

    public function getClienteFullName()
    {
        return $this->pago->getUsuario()->getFullName();
    }

    public function getSucursal()
    {
        return $this->pago->getSucursalNombre();
    }

    public function getTipo()
    {
        return $this->pago->getBoletoInventario()
            ->getNombre();
    }

    public function getCodigo()
    {
        return $this->pago->getCodigoValidacion();
    }

    public function getLote()
    {
        return $this->pago->getLote();
    }

    public function getCantidad()
    {
        return $this->pago->getCantidadBoletosComprados();
    }

    public function getMonto()
    {
        return $this->pago->getMonto();
    }

    public function getUsed()
    {
        return $this->pago->is('DISFRUTADO') ? true: false;
    }
}