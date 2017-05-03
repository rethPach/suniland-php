<?php
/**
 * Created by PhpStorm.
 * User: NPACHECO
 * Date: 06/02/2017
 * Time: 09:10 AM
 */

namespace Suniland\ComunBundle\Entity;


use Doctrine\Common\Collections\ArrayCollection;
use Suniland\ComunBundle\Exceptions\StockDecrementException;

class BoletoInventario
{
    protected $sucursal;
    protected $precio;
    protected $stock;
    protected $nombre;
    protected $historicoPrecio;
    protected $id;

    public function __construct(SucursalParque $sucursal, Price $precio, Stock $stock, $nombre)
    {
        $this->historicoPrecio = new ArrayCollection();
        $this->setPrecio($precio);
        $this->stock = $stock;
        $this->nombre = $nombre;
        $this->sucursal = $sucursal;
    }

    public function debitaTemporalmenteLaCantidadDisponibleDelStock($cantidadDeBoletoComprados)
    {
        $this->stock
            ->debitaTemporalmenteLaCantidadDisponibleDelStock($cantidadDeBoletoComprados);
    }

    public function getId()
    {
        return $this->id;
    }

    public function setPrecio(Price $precio)
    {
        $this->precio = $precio;
        $this->addHistoricoPrecio($precio);
    }

    protected function addHistoricoPrecio(Price $price)
    {
        $this->historicoPrecio->add($price);
    }

    public function getHistoricoPrecio()
    {
        return $this->historicoPrecio;
    }

    public function getPrecio()
    {
        return $this->precio;
    }

    public function getStock()
    {
        return $this->stock;
    }

    public function setStockCantidadDisponible($accion, $nuevaCantidad)
    {
        $this->stock->setCantidadDisponible($accion, $nuevaCantidad);
    }
    /*
     * Esto pertenece a logica de presentacion debes
     * crear un presentados para esto
     * **/
    public function sucursalNombre()
    {
        return $this->sucursal->getNombre();
    }

    public function getNombre()
    {
        return $this->nombre;
    }

    public function setNombre($nombre)
    {
        $this->nombre = $nombre;
    }

    public function stockCantidadVendida()
    {
        return $this->stock->getCantidadVendida();
    }

    public function stockCantidadDisponible()
    {
        return $this->stock->getCantidadDisponible();
    }

    public function isActivo()
    {
        return $this->sucursal->getActivo() ? 'Si' : 'No';
    }

    /*
     * Esto pertenece a logica de presentacion debes
     * crear un presentados para esto
     * **/
    public function getPrecioValue()
    {
        return $this->precio->getValue();
    }

    public function venta($cantidadBoletosComprados)
    {
        $this->assertThatExistanBoletosSuficientes($cantidadBoletosComprados);
        $this->stock->venta($cantidadBoletosComprados);
    }

    public function assertThatExistanBoletosSuficientes($cantidadBoletosComprados)
    {
        $stockValidation = $this->stock->getCantidadDisponible() - $cantidadBoletosComprados;
        if($stockValidation < 0)
            throw new StockDecrementException('Stock Insuficiente');
    }

    public function getSucursal()
    {
        return $this->sucursal;
    }

    public function devolucion($cantidadBoletosDevueltos)
    {
        $this->setStockCantidadDisponible('increment', $cantidadBoletosDevueltos);
    }
}