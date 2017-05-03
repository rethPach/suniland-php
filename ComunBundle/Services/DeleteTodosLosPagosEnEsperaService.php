<?php
/**
 * Created by PhpStorm.
 * User: NPACHECO
 * Date: 09/02/2017
 * Time: 08:32 PM
 */

namespace Suniland\ComunBundle\Services;


use Doctrine\ORM\EntityManager;

class DeleteTodosLosPagosEnEsperaService
{
    protected $entityManager;

    public function __construct(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function execute()
    {




    }



}