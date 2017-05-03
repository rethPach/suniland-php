<?php
/**
 * Created by PhpStorm.
 * User: NPACHECO
 * Date: 07/02/2017
 * Time: 11:41 AM
 */

namespace Suniland\ComunBundle\Services;

use Doctrine\ORM\EntityManager;
use Suniland\ComunBundle\Entity\BoletoInventario;
use Suniland\ComunBundle\Entity\Pay;
use Suniland\ComunBundle\Entity\PayStatus;
use Suniland\ComunBundle\Entity\Usuario;
use Suniland\ComunBundle\Exceptions\BoletoPriceChangeException;

class CheckoutService
{
    protected $entityManager;
    protected $medioPago;

    public function __construct(EntityManager $entityManager, $medioPago)
    {
        $this->entityManager = $entityManager;
        $this->setMedioPago($medioPago);
    }

    public function getMedioPago()
    {
        return $this->medioPago;
    }

    protected function em()
    {
        return $this->entityManager;
    }

    public function setMedioPago($medioPago)
    {
        $this->medioPago = $medioPago['tdc'];
    }

    public function handle($attrs, Usuario $usuario, BoletoInventario $boleto)
    {
        $status = $this->getStatusCreado();

        $this
            ->assertThatPrecioBoletoNoHallaCambiado(
                $boleto,
                $attrs['cantidadBoletosComprados'],
                $attrs['amount']
            )
            ->assertThatExitaStockSuficiente(
                $boleto,
                $attrs['cantidadBoletosComprados']
            );

        $pago = new Pay($usuario, $boleto, $status, $boleto->getPrecio(), [
            'cantidadBoletosComprados'=>$attrs['cantidadBoletosComprados'],
            'medioPago'=>$this->getMedioPago(),
            'amount'=>$attrs['amount']
        ]);

        $this->em()->persist($pago);
        $this->em()->flush();

        return $pago;
    }

    protected function getStatusEnEspera()
    {
        return $this->em()
            ->getRepository('SunilandComunBundle:PayStatus')
            ->findBy(['nombre'=>'EN_ESPERA'])[0];
    }

    protected function getStatusCreado()
    {
        return $this->em()
            ->getRepository('SunilandComunBundle:PayStatus')
            ->findBy(['nombre'=>'CREADO'])[0];
    }

    protected function assertThatExitaStockSuficiente(BoletoInventario $boleto, $cantidadBoletosComprados)
    {
        $boleto->assertThatExistanBoletosSuficientes(
            $cantidadBoletosComprados
        );
    }

    protected function assertThatPrecioBoletoNoHallaCambiado(BoletoInventario $boleto, $cantidadBoletosComprados, $amount)
    {
        $precioActualParaElBoleto = $boleto->getPrecioValue();
        $amountActual = $precioActualParaElBoleto * $cantidadBoletosComprados;
        if($amount != $amountActual)
            throw new BoletoPriceChangeException('Boleto Price Change');

        return $this;
    }

}