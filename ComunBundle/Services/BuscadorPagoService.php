<?php
/**
 * Created by PhpStorm.
 * User: NPACHECO
 * Date: 09/02/2017
 * Time: 06:19 PM
 */

namespace Suniland\ComunBundle\Services;


use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\EntityManager;
use Suniland\ComunBundle\TransferObjects\BuscadorCriteria;

class BuscadorPagoService
{
    protected $entityManager;
    protected $query;
    protected $parameters;

    public function __construct(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
        $this->query = new ArrayCollection();
    }

    protected function em()
    {
        return $this->entityManager;
    }

    public function buscar(BuscadorCriteria $buscadorCriteria)
    {
        $this->setParametros($buscadorCriteria);

        return $this->em()
            ->createQuery($this->getQuery())
            ->setParameters($this->getParameters())
            ->getResult();

    }

    private function getQuery()
    {
        $this->query->add("SELECT pago, boleto, precio, stock, sucursal, usuario");
        $this->query->add("FROM SunilandComunBundle:Pay pago");

        $this->query->add("JOIN pago.boletoInventario boleto");
        $this->query->add("JOIN pago.usuario usuario");
        $this->query->add("JOIN boleto.sucursal sucursal");
        $this->query->add("JOIN boleto.precio precio");
        $this->query->add("JOIN boleto.stock stock");

        $this->query->add("WHERE boleto.id = :boletoId");
        $this->query->add("OR boleto.nombre LIKE :boletoNombre");
        $this->query->add("OR sucursal.id = :sucursalId");
        $this->query->add("OR sucursal.nombre LIKE :sucursalNombre");
        $this->query->add("OR usuario.id = :usuarioId");
        $this->query->add("OR usuario.nombre LIKE :usuarioNombre");
        $this->query->add("OR usuario.apellido LIKE :usuarioApellido");
        $this->query->add("OR pago.createdAt BETWEEN :rangoFrom AND :rangoTo");

        //var_dump(join(' ', $this->query->toArray())); die;
        return join(' ', $this->query->toArray());
    }

    private function setParametros(BuscadorCriteria $buscadorCriteria)
    {
        $this->parameters = [
            'boletoId' => $buscadorCriteria->getBoletoId(),
            'boletoNombre'=>$buscadorCriteria->getBoletoNombre(),
            'sucursalId'=>$buscadorCriteria->getSucursalId(),
            'sucursalNombre'=>$buscadorCriteria->getSucursalNombre(),
            'usuarioId'=>$buscadorCriteria->getUsuarioId(),
            'usuarioNombre'=>$buscadorCriteria->getUsuarioNombre(),
            'usuarioApellido'=>$buscadorCriteria->getUsuarioApellido(),
            'rangoFrom'=>$buscadorCriteria->getRangoFrom(),
            'rangoTo'=>$buscadorCriteria->getRangoTo()
        ];
    }

    private function getParameters()
    {
        return $this->parameters;
    }
}