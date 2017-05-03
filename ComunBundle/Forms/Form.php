<?php
/**
 * Created by PhpStorm.
 * User: NPACHECO
 * Date: 05/02/2017
 * Time: 11:12 AM
 */

namespace Suniland\ComunBundle\Forms;

abstract class Form
{
    public $action;
    public $method;
    public $submitButtonText;
    public $fields;

    public function __construct($action, $method, $submitButtonText, $config)
    {
        $this->action = $action;
        $this->method = $method;
        $this->submitButtonText = $submitButtonText;
        $this->fields = $this->fields();
    }

    abstract public function fields();


    public function fieldValue($key)
    {
        return $this->fields[$key]['value'];
    }

    public function fieldName($key)
    {
        return $this->fields[$key]['name'];
    }

    public function changeValue($key, $value)
    {
        $this->fields[$key]['value'] = $value;
    }

}