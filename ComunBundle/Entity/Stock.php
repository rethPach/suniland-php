<?php
/**
 * Created by PhpStorm.
 * User: NPACHECO
 * Date: 06/02/2017
 * Time: 09:11 AM
 */

namespace Suniland\ComunBundle\Entity;


use Suniland\ComunBundle\Exceptions\StockDecrementException;

class Stock
{
    const NINGUNA = 0;

    protected $cantidadDisponible;
    protected $cantidadVendida;
    protected $id;

    public function __construct($cantidadDisponible = 20)
    {
        $this->cantidadDisponible = $cantidadDisponible;
        $this->cantidadVendida = self::NINGUNA;
    }

    public function debitaTemporalmenteLaCantidadDisponibleDelStock($cantidadDecrement)
    {
        $this->setCantidadDisponible('decrement', $cantidadDecrement);
    }

    public function getCantidadVendida()
    {
        return $this->cantidadVendida;
    }

    public function getCantidadDisponible()
    {
        return $this->cantidadDisponible;
    }

    public function setCantidadDisponible($accion, $nuevaCantidad)
    {
        switch($accion) {
            case 'increment':
                $this->cantidadDisponible += $nuevaCantidad;
            break;
            case 'decrement':
                $this->assertThatPuedoDecremntar($nuevaCantidad);
                $this->cantidadDisponible -= $nuevaCantidad;
            break;
            default:
                throw new \Exception('Al setear cantidad de stock, la accion no esta permitida');
            break;
        }
    }

    protected function assertThatPuedoDecremntar($cantidadDecrement)
    {
        $cantidadDisponible = $this->cantidadDisponible;
        $cantidadDisponibleUpdate = $cantidadDisponible - $cantidadDecrement;
        if($cantidadDisponibleUpdate < 0)
            throw new StockDecrementException('Lanzada desde Stock');
    }

    public function venta($cantidadBoletosComprados)
    {
        $this->cantidadVendida += $cantidadBoletosComprados;
    }

}