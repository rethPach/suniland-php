<?php
/**
 * Created by PhpStorm.
 * User: NPACHECO
 * Date: 07/02/2017
 * Time: 12:56 AM
 */

namespace Suniland\ComunBundle\Services;

use Suniland\ComunBundle\Entity\Pay;

class Boton123PagoService
{
    protected $pago;

    protected function setPago(Pay $pago)
    {
        $this->pago = $pago;
    }

    protected function config($key)
    {
        $config = [
            '123PagoUrl'=>'http://190.153.48.117/msBotonDePago/',
            'nbproveedor' => 'SUNILAND PARK',
            'cs' => 'e6018101b0da0bde33ec8f675ca4f2d8',
            'ancho' => '190px'
        ];
        return $config[$key];
    }

    public function getBoton123Pago(Pay $pago)
    {
        $this->setPago($pago);
        return $this->doRequest();
    }

    protected function parameters()
    {
        return [
            'nbproveedor' => $this->config('nbproveedor'),
            'cs' => $this->config('cs'),
            'ancho' => $this->config('ancho'),
            'ap' => $this->pago->usuarioApellido(),
            'nb' => $this->pago->usuarioNombre(),
            'ci' => $this->pago->usuarioCedula(),
            'em' => $this->pago->usuarioCorreo(),
            'nai' => $this->pago->getId(),
            'co' => $this->pago->getConcepto(),
            'tl' => $this->pago->usuarioTelefono(),
            'mt' => $this->pago->getMonto(),
        ];
    }

    protected function url()
    {
        return $this->config('123PagoUrl');
    }

    protected function doRequest()
    {
        $post_string = "";
        foreach( $this->parameters() as $key => $value )
            $post_string .= "$key=" . urlencode( $value ) . "&";

        $post_string = rtrim( $post_string, "& " );
        $fullurl = $this->url() . "?" . $post_string;

        $request = curl_init();
        curl_setopt($request, CURLOPT_URL, $fullurl);
        curl_setopt($request, CURLOPT_HEADER, 0);
        curl_setopt($request, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($request, CURLOPT_BINARYTRANSFER, true);
        $post_response = curl_exec($request);
        curl_close ($request);

        return $post_response;
    }
}
