<?php
/**
 * Created by PhpStorm.
 * User: NPACHECO
 * Date: 06/02/2017
 * Time: 04:18 PM
 */

namespace Suniland\ComunBundle\Entity;


class PayStatus
{

    protected $nombre;
    protected $id;

    public function __construct()
    {

    }

    public function is($name)
    {
        return $this->nombre === $name;
    }

    public function getNombre()
    {
        return $this->nombre;
    }

    public function getId()
    {
        return $this->id;
    }
}