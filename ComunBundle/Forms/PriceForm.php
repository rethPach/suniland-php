<?php
/**
 * Created by PhpStorm.
 * User: NPACHECO
 * Date: 06/02/2017
 * Time: 03:00 PM
 */

namespace Suniland\ComunBundle\Forms;


use Suniland\ComunBundle\Entity\BoletoInventario;

class PriceForm extends Form
{
    public function fields()
    {
        return [
             'sucursal_name'=>[
                 'name'=>'sucursal_name',
                 'value'=>''
             ],
            'boleto_name'=>[
                'name'=>'boleto_name',
                'value'=>''
            ],
            'precio'=>[
                'name'=>'precio',
                'value'=>''
            ]
        ];
    }

    public function overrideFields(BoletoInventario $boletoInventario)
    {
        $this->changeValue('sucursal_name', $boletoInventario->sucursalNombre());
        $this->changeValue('boleto_name', $boletoInventario->getNombre());
        $this->changeValue('precio', $boletoInventario->getPrecioValue());
    }
}