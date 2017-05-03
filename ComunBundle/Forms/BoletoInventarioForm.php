<?php
/**
 * Created by PhpStorm.
 * User: NPACHECO
 * Date: 05/02/2017
 * Time: 11:12 AM
 */

namespace Suniland\ComunBundle\Forms;

use Suniland\ComunBundle\Entity\BoletoInventario;

class BoletoInventarioForm extends Form
{
    public $isEditable;

    public function __construct($action, $method, $submitButtonText, $config)
    {
        parent::__construct($action, $method, $submitButtonText, $config);
        $this->isEditable = false;
    }

    public function fields()
    {
        return [
            'nombre'=>[
                'name'=>'nombre',
                'value'=>''
            ],
            'cantidad_disponible'=>[
                'name'=>'cantidad_disponible',
                'value'=>''
            ],
            'cantidad_vendida'=>[
                'name'=>'cantidad_vendida',
                'value'=>''
            ]
        ];
    }

    public function overrideFields(BoletoInventario $boletoInventario)
    {
        $this->isEditable = true;

        $this->changeValue('nombre', $boletoInventario->getNombre());
        $this->changeValue('cantidad_disponible', $boletoInventario->stockCantidadDisponible());
        $this->changeValue('cantidad_vendida', $boletoInventario->stockCantidadVendida());

    }

}