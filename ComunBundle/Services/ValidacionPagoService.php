<?php
/**
 * Created by PhpStorm.
 * User: NPACHECO
 * Date: 08/02/2017
 * Time: 09:39 PM
 */

namespace Suniland\ComunBundle\Services;


use Doctrine\ORM\EntityManager;
use Suniland\ComunBundle\Exceptions\PagoDeberiaEstarEnEstadoCreadoException;
use Suniland\ComunBundle\Repositories\PagoRepo;
use Suniland\ComunBundle\Repositories\PayStatusRepo;

class ValidacionPagoService
{
    protected $pagoRepo;
    protected $pago;
    protected $boton123PagoService;
    protected $payStatusRepo;
    protected $anPayStatusEnEspera;
    protected $boton123Pago;
    protected $entityManager;

    public function __construct(
        PagoRepo $pagoRepo,
        Boton123PagoService $boton123PagoService,
        PayStatusRepo $payStatusRepo,
        EntityManager $entityManager
    )
    {
        $this->pagoRepo = $pagoRepo;
        $this->boton123PagoService = $boton123PagoService;
        $this->payStatusRepo = $payStatusRepo;
        $this->entityManager = $entityManager;
    }

    public function handle($pagoId)
    {
        try {

            $this->setPago($pagoId);
            $this->assert_that_pago_status_is_creado();
            $this->setAnPayStatusEnEspera();
            $this->setBoton123Pago();

            $this->pago->enEspera($this->anPayStatusEnEspera);

            $this->entityManager->flush();

        } catch (PagoDeberiaEstarEnEstadoCreadoException $e) {
            throw $e;
        }
    }

    protected function setBoton123Pago()
    {
        $this->boton123Pago = $this->boton123PagoService
            ->getBoton123Pago($this->pago);
    }

    protected function setAnPayStatusEnEspera()
    {
        $this->anPayStatusEnEspera = $this->payStatusRepo
            ->findByName('EN_ESPERA');
    }


    public function assert_that_pago_status_is_creado()
    {
        if(!$this->pago->is('CREADO'))
            throw new PagoDeberiaEstarEnEstadoCreadoException();
    }

    protected function setPago($pagoId)
    {
        $this->pago = $this->pagoRepo->find($pagoId);
    }

    public function getPago()
    {
        return $this->pago;
    }

    public function getBoton123Pago()
    {
        return $this->boton123Pago;
    }
}