<?php

namespace Suniland\MainBundle\Controller;

use Suniland\ComunBundle\Exceptions\BoletoPriceChangeException;
use Suniland\ComunBundle\Exceptions\PagoDeberiaEstarEnEstadoCreadoException;
use Suniland\ComunBundle\Exceptions\ParaQueElPagoPuedaSerEliminadoDeberiaEstarEnEstatusEnEsperaException;
use Suniland\ComunBundle\Exceptions\StatusCode123PagoInvalidoException;
use Suniland\ComunBundle\Exceptions\StockDecrementException;
use Suniland\ComunBundle\Exceptions\UsuarioNoAuthenticadoException;
use Symfony\Component\HttpFoundation\Request;

class CheckoutController extends BaseController
{
    public function indexAction()
    {
        try {
            $this->assertThatUserAuth();
            $view = 'SunilandMainBundle:Checkout:index.html.twig';
            return $this->render($view);
        }

        catch (UsuarioNoAuthenticadoException $e) {
            $this->addFlash('error', 'Ud no tiene acceso, por favor registrese o loguese.');
            return $this->redirectToRoute('_inicioSesion');
        }
    }

    public function sucursalesAction()
    {
        $sucursalRepo = $this->get('suniland_comun.sucursal_repo');
        return $this->jsonResponse($sucursalRepo->all());
    }

    public function checkoutAction(Request $request)
    {
        try {

            $this->assertThatUserAuth();

            $form = $request->request->all();
            $checkoutService = $this->get('suniland_comun.checkout_service');
            $boletoRepo = $this->get('suniland_comun.boleto_inventario_repo');
            $boletoComprado = $boletoRepo->find($form['boletoId']);

            $pago = $checkoutService->handle([
                'cantidadBoletosComprados' => $form['cantidadBoletosComprados'],
                'amount' => $form['amount']
            ], $this->authUser, $boletoComprado);

            return $this->redirectToRoute(
                '_validacionPago',
                ['pagoId' => $pago->getId()]
            );
        }

        catch (StockDecrementException $e) {
            $this->addFlash('error', 'Lo sentimos no disponemos de boletos suficientes!');
            return $this->redirectToRoute('_checkout');
        }

        catch (BoletoPriceChangeException $e) {
            $this->addFlash('error', 'El precio del boleto que selecciono ha sido actualizado!');
            return $this->redirectToRoute('_checkout');
        }

        catch(UsuarioNoAuthenticadoException $e) {
            $this->addFlash('error', 'Ud no tiene accesso, por favor registrese o logueese.');
            return $this->redirectToRoute('_inicioSesion');
        }

    }

    public function boletoInventarioBySucursalAction($sucursalId)
    {
        $boletoRepo = $this->get('suniland_comun.boleto_inventario_repo');
        $boleto = $boletoRepo->findBySucursalId($sucursalId);
        return $this->jsonResponse($boleto);
    }

    public function callback123PagoAction(Request $request)
    {
        try {

            $form = $request->request->all();

            $callback123PagoService = $this->get('suniland_comun.callback_123_pago_service');
            $callback123PagoService->handle([
                'pagoId' => $form['parametro2'],
                'statusCode' => $form['parametro1']
            ]);

            var_dump('Proceso de pago complete');die;
        }

        catch (StockDecrementException $e) {
            return $this->redirectToRoute('_checkout');
        }

        catch (StatusCode123PagoInvalidoException $e) {
            return $this->redirectToRoute('_checkout');
        }
    }

    public function validacionPagoAction($pagoId)
    {
        try {

            $view = 'SunilandMainBundle:Checkout:validacionPago.html.twig';
            $validacionPagoService = $this->get('suniland_comun.validacion_pago_service');
            $validacionPagoService->handle($pagoId);

            return $this->render($view, [
                'pago' => $validacionPagoService->getPago(),
                'boton123Pago' => $validacionPagoService->getBoton123Pago()
            ]);

        }

        catch (PagoDeberiaEstarEnEstadoCreadoException $e) {
            $this->addFlash('info', 'Su Pago esta en estado espera.');
            return $this->redirectToRoute('_checkout');
        }
    }

    public function deletePagoAction($pagoId)
    {
        try {
            $deletePagoService = $this->get('suniland_comun.delete_pago_service');
            $deletePagoService->handle($pagoId);
            var_dump('ok'); die;
        }

        catch (ParaQueElPagoPuedaSerEliminadoDeberiaEstarEnEstatusEnEsperaException $e) {
            var_dump($e->getMessage()); die;
        }

        catch(\Exception $e) {
            var_dump($e->getMessage()); die;
        }

    }
}