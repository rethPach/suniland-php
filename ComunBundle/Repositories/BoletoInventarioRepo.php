<?php
/**
 * Created by PhpStorm.
 * User: NPACHECO
 * Date: 07/02/2017
 * Time: 02:53 PM
 */

namespace Suniland\ComunBundle\Repositories;


use Doctrine\ORM\EntityManager;

class BoletoInventarioRepo
{

    public function __construct(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
        $this->repo = $entityManager
            ->getRepository('SunilandComunBundle:BoletoInventario');
    }

    public function find($id)
    {
        $query = $this->entityManager->createQuery("
        SELECT boleto, precio, stock, sucursal
        FROM SunilandComunBundle:BoletoInventario boleto
        JOIN boleto.precio precio
        JOIN boleto.stock stock
        JOIN boleto.sucursal sucursal
        WHERE boleto.id = :boletoId
        ");
        $query->setParameter('boletoId', $id);
        return $query->getResult()[0];
    }

    public function findBySucursalId($sucursalId)
    {
        $query = $this->entityManager->createQuery("
        SELECT boleto, precio, stock, sucursal
        FROM SunilandComunBundle:BoletoInventario boleto
        JOIN boleto.precio precio
        JOIN boleto.stock stock
        JOIN boleto.sucursal sucursal
        WHERE sucursal.id = :sucursalId
        ORDER BY boleto.id DESC
        ");
        $query->setParameter('sucursalId', $sucursalId);
        return $query->getResult()[0];
    }

}