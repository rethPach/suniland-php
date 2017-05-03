<?php
/**
 * Created by PhpStorm.
 * User: NPACHECO
 * Date: 07/02/2017
 * Time: 02:53 PM
 */

namespace Suniland\ComunBundle\Repositories;


use Doctrine\ORM\EntityManager;

class SucursalRepo
{

    public function __construct(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
        $this->repo = $entityManager
            ->getRepository('SunilandComunBundle:SucursalParque');
    }

    public function all()
    {
        return $this->repo->findAll();
    }

}