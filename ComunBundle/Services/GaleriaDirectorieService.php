<?php
/**
 * Created by PhpStorm.
 * User: NPACHECO
 * Date: 16/02/2017
 * Time: 09:17 PM
 */

namespace Suniland\ComunBundle\Services;


class GaleriaDirectorieService
{

    public function __construct($roorDir)
    {
        $this->webRoot = realpath($roorDir . '/../web');
        $this->uploads = '/uploads/';
    }

    public function getDirectorieName()
    {
        return $this->directorieName;
    }

    public function setDirectorieName($sucursalParque)
    {
        $directorieName = join('_', [
            $sucursalParque->getNombreCarpeta(),
            $sucursalParque->getId()]
        );
        $this->directorieName = $this->webRoot.$this->uploads.$directorieName;
    }

    public function createDirectorie($sucursalParque)
    {
        $this->setDirectorieName($sucursalParque);

        if (!is_dir($this->getDirectorieName())) {
            mkdir($this->getDirectorieName(), 0777, true);
            chmod($this->getDirectorieName(), 0777);
        }
    }

    public function renameDirectorio($sucursalParque, $oldName)
    {
        $this->setDirectorieName($sucursalParque);
        rename($this->getDirectorieName(), $oldName);
    }
}