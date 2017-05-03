<?php
/**
 * Created by PhpStorm.
 * User: NPACHECO
 * Date: 06/02/2017
 * Time: 03:54 PM
 */

namespace Suniland\ComunBundle\Entity;


use Suniland\ComunBundle\Exceptions\PagoStatusInputInvalidException;
use Suniland\ComunBundle\Exceptions\PagoStatusInvalidException;

class Pay
{
    const NINGUN_CODIGO_VALIDACION = 0;

    protected $lote;
    protected $usuario;
    protected $boletoInventario;
    protected $status;
    protected $createdAt;
    protected $completeAt;
    protected $completeAtFull;
    protected $cantidadBoletosComprados;
    protected $codigoValidacion;
    protected $medioPago;
    protected $concepto;
    protected $amount;
    protected $id;

    public function __construct(
        Usuario $usuario,
        BoletoInventario $boletoInventario,
        PayStatus $status,
        Price $price,
        $spec)
    {
        $this->usuario = $usuario;
        $this->boletoInventario = $boletoInventario;
        $this->setStatusCreado($status);
        $this->price = $price;
        $this->setCreatedAt();
        $this->setCantidadBoletosComprados($spec);
        $this->setCodigoValidacion(self::NINGUN_CODIGO_VALIDACION);
        $this->setMedioPago($spec);
        $this->setConcepto();
        $this->setAmount($spec['amount']);

    }

    public function is($payStatusName)
    {
        return $this->status->getNombre() === $payStatusName;
    }

    public function enEspera(PayStatus $status)
    {
        $this->assert_that_input_status_is_en_espera($status);
        $this->assert_that_mi_status_is_creado();
        $this->boletoInventario
        ->debitaTemporalmenteLaCantidadDisponibleDelStock($this->cantidadBoletosComprados);
        $this->status = $status;
    }

    protected function setStatusCreado(PayStatus $status)
    {
        $this->assert_that_input_status_is_creado($status);
        $this->status = $status;
    }

    protected function setStatusComplete($status)
    {
        $this->assert_that_input_status_is_complete($status);
        $this->assert_that_mi_status_is_en_espera();

        $this->status = $status;
    }

    protected function setCreatedAt()
    {
        $this->createdAt = new \DateTime('now');
    }

    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    protected function setConcepto()
    {
        $this->concepto = join(' ', [
            'Registro de compra de',$this->cantidadBoletosComprados,
            'Boletos',$this->boletoInventario->getNombre(),
            'para el usuario', $this->usuario->getNombre(), $this->usuario->getApellido(),
            'al parque', $this->boletoInventario->sucursalNombre()
        ]);
    }

    protected function setCantidadBoletosComprados($spec)
    {
        $this->cantidadBoletosComprados = $spec['cantidadBoletosComprados'];
    }

    public function setCodigoValidacion($codigoValidacion)
    {
        $this->codigoValidacion = $codigoValidacion;
    }

    protected function setMedioPago($spec)
    {
        $this->medioPago = $spec['medioPago'];
    }

    protected function setAmount($amount)
    {
        $this->amount = $amount;
    }

    protected function setLote()
    {
        $cantidadVendida = $this->boletoInventario->stockCantidadVendida();
        $inicio = $cantidadVendida + 1;
        $fin = $cantidadVendida + $this->cantidadBoletosComprados;
        $this->lote = join('-', [$inicio, $fin]);
    }

    public function complete(PayStatus $status, $codigoValidacion)
    {
        $this->setStatusComplete($status);
        $this->setLote();
        $this->setCodigoValidacion($codigoValidacion);
        $this->boletoInventario->venta($this->cantidadBoletosComprados);
        $this->setCompleteAt();
    }

    protected function setCompleteAt()
    {
        $this->completeAt = new \DateTime('now');
        $this->completeAtFull = new \DateTime('now');
    }

    public function getCompleteAt()
    {
        if($this->completeAt) {
            return $this->completeAt->format('Y-m-d');
        }

        return null;
    }

    public function getCompleteAtFull()
    {
        return $this->completeAtFull;
    }

    protected function assert_that_input_status_is_creado($status)
    {
        if(!$status->is('CREADO'))
            throw new PagoStatusInputInvalidException('El PayStatus input deberia ser CREADO');
    }

    protected function assert_that_input_status_is_complete($status)
    {
        if(!$status->is('COMPLETE'))
            throw new PagoStatusInputInvalidException('El PayStatus input deberia ser COMPLETE');

    }

    protected function assert_that_input_status_is_en_espera($status)
    {
        if(!$status->is('EN_ESPERA'))
            throw new PagoStatusInputInvalidException('El PayStatus input deberia ser EN_ESPERA');

    }

    protected function assert_that_input_status_is_disfrutado($status)
    {
        if(!$status->is('DISFRUTADO'))
            throw new PagoStatusInputInvalidException('El PayStatus input deberia ser DISFUTADO');
    }

    protected function assert_that_mi_status_is_creado()
    {
        if(!$this->status->is('CREADO'))
            throw new PagoStatusInvalidException('Mi Status deberia ser CREADO', 1);
    }

    protected function assert_that_mi_status_is_en_espera()
    {
        if(!$this->status->is('EN_ESPERA'))
            throw new PagoStatusInvalidException('Mi Status deberia ser EN_ESPERA', 2);
    }

    protected function assert_that_mi_status_is_complete()
    {
        if(!$this->status->is('COMPLETE'))
            throw new PagoStatusInvalidException('Mi Status deberia ser COMPLETE', 3);
    }

    public function disfutado(PayStatus $status)
    {
        $this->assert_that_input_status_is_disfrutado($status);
        $this->assert_that_mi_status_is_complete();

        $this->status = $status;
    }
    /*
     * Logica de presentacion sacar a un presenter
     * **/
    public function getId()
    {
        return $this->id;
    }

    public function getMonto()
    {
        return $this->amount;
    }

    public function getConcepto()
    {
        return $this->concepto;
    }

    public function usuarioNombre()
    {
        return $this->usuario->getNombre();
    }

    public function usuarioApellido()
    {
        return $this->usuario->getApellido();
    }

    public function usuarioCedula()
    {
        return $this->usuario->getCedula();
    }

    public function usuarioCorreo()
    {
        return $this->usuario->getCorreo();
    }

    public function usuarioTelefono()
    {
        return $this->usuario->getTelefono();
    }

    public function usuarioFullName()
    {
        return $this->usuario->getFullName();
    }

    public function getCantidadBoletosComprados()
    {
        return $this->cantidadBoletosComprados;
    }

    public function getMedioPago()
    {
        return $this->medioPago;
    }

    public function getSucursalNombre()
    {
        return $this->boletoInventario->sucursalNombre();
    }

    public function boletoPrecio()
    {
        return $this->boletoInventario->getPrecioValue();
    }

    public function boletoNombre()
    {
        return $this->boletoInventario->getNombre();
    }

    public function getBoletoInventario()
    {
        return $this->boletoInventario;
    }

    public function getUsuario()
    {
        return $this->usuario;
    }

    public function getStatus()
    {
        return $this->status;
    }

    public function getLote()
    {
        return $this->lote;
    }

    public function getCodigoValidacion()
    {
        return $this->codigoValidacion;
    }
}