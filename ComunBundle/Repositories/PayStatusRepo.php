<?php
/**
 * Created by PhpStorm.
 * User: NPACHECO
 * Date: 07/02/2017
 * Time: 02:53 PM
 */

namespace Suniland\ComunBundle\Repositories;


use Doctrine\ORM\EntityManager;

class PayStatusRepo
{

    public function __construct(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
        $this->repo = $entityManager
            ->getRepository('SunilandComunBundle:PayStatus');
    }

    public function all()
    {
        return $this->repo->findAll();
    }

    public function findByName($name)
    {
        return $this->repo->findBy(['nombre'=>$name])[0];
    }

}