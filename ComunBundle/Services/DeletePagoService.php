<?php
/**
 * Created by PhpStorm.
 * User: NPACHECO
 * Date: 08/02/2017
 * Time: 09:06 PM
 */

namespace Suniland\ComunBundle\Services;


use Doctrine\ORM\EntityManager;
use Suniland\ComunBundle\Exceptions\ParaQueElPagoPuedaSerEliminadoDeberiaEstarEnEstatusEnEsperaException;
use Suniland\ComunBundle\Repositories\PagoRepo;

class DeletePagoService
{
    protected $pagoRepo;
    protected $pago;
    protected $entityManager;

    public function __construct(EntityManager $entityManager, PagoRepo $pagoRepo)
    {
        $this->pagoRepo = $pagoRepo;
        $this->entityManager = $entityManager;
    }

    public function handle($pagoId)
    {
        $this->setPago($pagoId);
        $this->assert_that_pago_status_is_en_espera();

        $boletoInventario = $this->pago->getBoletoInventario();
        $boletoInventario->devolucion(
            $this->pago->getCantidadBoletosComprados()
        );

        $this->entityManager->remove($this->pago);
        $this->entityManager->flush();
    }

    protected function setPago($pagoId)
    {
        $this->pago = $this->pagoRepo->find($pagoId);
        if(!$this->pago)
            throw new \Exception('El pago ya fue eliminado');
    }

    protected function assert_that_pago_status_is_en_espera()
    {
        if(!$this->pago->is('EN_ESPERA'))
            throw new ParaQueElPagoPuedaSerEliminadoDeberiaEstarEnEstatusEnEsperaException(
                'Para que el pago pueda ser eliminado debe estar en espera');
    }
}