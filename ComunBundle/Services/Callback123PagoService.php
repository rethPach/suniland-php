<?php
/**
 * Created by PhpStorm.
 * User: NPACHECO
 * Date: 07/02/2017
 * Time: 02:21 PM
 */

namespace Suniland\ComunBundle\Services;


use Doctrine\ORM\EntityManager;
use Suniland\ComunBundle\Exceptions\StatusCode123PagoInvalidoException;
use Suniland\ComunBundle\Exceptions\StockDecrementException;

class Callback123PagoService
{
    protected $entityManager;
    protected $pago;
    protected $codigoValidacionService;

    public function __construct(EntityManager $entityManager, $codigoValidacionService)
    {
        $this->entityManager = $entityManager;
        $this->codigoValidacionService = $codigoValidacionService;
    }

    public function handle($attrs)
    {
        try {
            if($attrs['statusCode'] !== '00')
                throw new StatusCode123PagoInvalidoException('PagoStatusCodeInvalidException');

            $this->pago = $this->findPago($attrs['pagoId']);

            $this->pago->complete($this->statusComplete(), $this->getCodigoValidacion());

            $this->entityManager->flush();
        }

        catch(StockDecrementException $e) {
            throw $e;
        }

        catch (StatusCode123PagoInvalidoException $e) {
            throw $e;
        }

    }

    protected function getCodigoValidacion()
    {
       return $this->codigoValidacionService
           ->codificar($this->pago->getId());
    }

    protected function findPago($id)
    {
        return $this->entityManager
            ->getRepository('SunilandComunBundle:Pay')
            ->find($id);
    }

    protected function statusComplete()
    {
        return $this->entityManager
            ->getRepository('SunilandComunBundle:PayStatus')
            ->findBy(['nombre'=>'COMPLETE'])[0];
    }

    public function pagoComplete()
    {
        return $this->pago;
    }
}

