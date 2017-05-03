<?php
/**
 * Created by PhpStorm.
 * User: NPACHECO
 * Date: 12/02/2017
 * Time: 06:12 PM
 */

namespace Suniland\ComunBundle\Services;


class CodigoValidacionService
{
    public function __construct()
    {

    }

    public function codificar($id)
    {
        $caracteres = "ABCDEFGHIJKLMNPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz123456789";
        $contrasena = "";
        for($i=0; $i<8; $i++){
            $contrasena .= substr($caracteres,rand(0,strlen($caracteres)),1);
        }
        return "$contrasena-$id";
    }

    public function decodificar($codigo)
    {
        return explode('-', $codigo)[1];
    }
}