<?php
/**
 * Created by PhpStorm.
 * User: NPACHECO
 * Date: 07/02/2017
 * Time: 05:30 PM
 */

namespace Suniland\ComunBundle\Repositories;


use Doctrine\ORM\EntityManager;
use Suniland\ComunBundle\TransferObjects\PagoTable;

class PagoRepo
{
    protected $entityManager;
    protected $repo;

    public function __construct(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
        $this->repo = $entityManager
            ->getRepository('SunilandComunBundle:Pay');
    }

    public function find($id)
    {
        return $this->repo->find($id);
    }

    public function all()
    {
        $query = $this->entityManager->createQuery("
        SELECT pago, boleto, sucursal, usuario
        FROM Suniland\ComunBundle\Entity\Pay pago
        JOIN pago.boletoInventario boleto
        JOIN boleto.sucursal sucursal
        JOIN pago.usuario usuario
        ");

        return $query->getResult();
    }

}