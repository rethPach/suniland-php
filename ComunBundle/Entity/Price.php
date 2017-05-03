<?php
/**
 * Created by PhpStorm.
 * User: NPACHECO
 * Date: 06/02/2017
 * Time: 09:11 AM
 */

namespace Suniland\ComunBundle\Entity;


class Price
{
    protected $value;
    protected $id;

    public function __construct($value)
    {
        $this->value = $value;
    }

    public function getValue()
    {
        return $this->value;
    }
}