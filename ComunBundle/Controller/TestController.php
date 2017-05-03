<?php
/**
 * Created by PhpStorm.
 * User: NPACHECO
 * Date: 07/02/2017
 * Time: 11:57 AM
 */

namespace Suniland\ComunBundle\Controller;

use Dompdf\Dompdf;
use Suniland\ComunBundle\Entity\SucursalParque;
use Suniland\ComunBundle\TransferObjects\BuscadorCriteria;
use Suniland\MainBundle\Controller\BaseController;

class TestController extends BaseController
{
    public function testAction()
    {
        //$this->assertThatUserAuth();

        //$this->pruebaDelServicioCheckoutService();

        //$this->pruebaBoton123Pago();

        //$this->pruebaCallback123Pago();

        //$this->testReportes();

        //$this->testValidacionPago();

    }

    protected function getUserAuth()
    {
        return $this->em()
            ->getRepository('SunilandComunBundle:Usuario')
            ->find(8);
    }

    public function pruebaDelServicioCheckoutService()
    {
        $checkoutService = $this->get('suniland_comun.checkout_service');
        $boletoRepo = $this->get('suniland_comun.boleto_inventario_repo');
        $boletoComprado = $boletoRepo->find(1);
        $this->authUser = $this->getUserAuth();

        $pago = $checkoutService->handle([
            'cantidadBoletosComprados'=>1,
            'amount'=>122
        ], $this->authUser, $boletoComprado);

        var_dump('Se ha generado un nuevo pago con id '.$pago->getId()); die;
    }

    public function pruebaBoton123Pago()
    {
        $boton123Pago = $this->get('suniland_comun.boton_123_pago_service');
        $pagoRepo = $this->get('suniland_comun.pago_repo');
        var_dump($boton123Pago->getBoton123Pago($pagoRepo->find(200))); die;

    }

    public function pruebaCallback123Pago()
    {
        $callback123PagoService = $this->get('suniland_comun.callback_123_pago_service');
        $callback123PagoService->handle([
            'pagoId'=>3000,
            'statusCode'=>'00'
        ]);

        var_dump($callback123PagoService->pagoComplete()); die;
    }

    public function testDomPdf()
    {
        $dompdf = new Dompdf();
        $dompdf->loadHtml('<div>hola</div>');
        $dompdf->render();
        $dompdf->stream();
    }

    public function testReportes()
    {
        $buscadorPagoService = $this->get('suniland_comun.buscador_pago_service');

        $buscadorCriteria = new BuscadorCriteria();
        $buscadorCriteria
            ->setBoletoId(0)
            ->setBoletoNombre('')
            ->setSucursalId(0)
            ->setSucursalNombre('')
            ->setUsuarioId(8)
            ->setUsuarioNombre('')
            ->setUsuarioApellido('')
            ->setRangoFrom('')
            ->setRangoTo('');

        var_dump($buscadorPagoService->buscar($buscadorCriteria)); die;

    }

    public function testValidacionPago()
    {
        $validacionPagoService = $this->get('suniland_comun.validacion_pago_service');
        $validacionPagoService->handle(3000);

        var_dump($validacionPagoService->getPago()); die;
    }
}