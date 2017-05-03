<?php
/**
 * Created by PhpStorm.
 * User: NPACHECO
 * Date: 05/02/2017
 * Time: 11:12 AM
 */

namespace Suniland\ComunBundle\Forms;

use Suniland\ComunBundle\Entity\SucursalParque;

class SucursalForm extends Form
{
    public $isEditable;

    public function __construct($action, $method, $submitButtonText, $config)
    {
        $this->isEditable = false;
        parent::__construct($action, $method, $submitButtonText, $config);
    }

    public function fields()
    {
       return [
           'nombre'=>[
               'name'=>'nombre',
               'value'=>'Suniland Test'
           ],
           'direccion'=>[
               'name'=>'direccion',
               'value'=>'Suniland Test'
           ],
           'telefono'=>[
               'name'=>'telefono',
               'value'=>'111111'
           ],
           'telefono_alternativo'=>[
               'name'=>'telefono_alternativo',
               'value'=>'2222222'
           ],
           'nombre_carpeta'=>[
               'name'=>'nombre_carpeta',
               'value'=>'test'
           ],
           'precio'=>[
               'name'=>'precio',
               'value'=>0
           ],
           'stock'=>[
               'name'=>'stock',
               'value'=>20
           ]
       ];
   }

   public function overrideFields(SucursalParque $sucursalParque)
   {
       $this->isEditable = true;

       $this->changeValue('nombre', $sucursalParque->getNombre());
       $this->changeValue('direccion', $sucursalParque->getDireccion());
       $this->changeValue('telefono', $sucursalParque->getTelefono());
       $this->changeValue('telefono_alternativo', $sucursalParque->getTelefonoAlternativo());
       $this->changeValue('nombre_carpeta', $sucursalParque->getNombreCarpeta());
   }

}