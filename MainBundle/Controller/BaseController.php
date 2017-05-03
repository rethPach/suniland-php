<?php
/**
 * Created by PhpStorm.
 * User: NPACHECO
 * Date: 07/02/2017
 * Time: 02:37 PM
 */

namespace Suniland\MainBundle\Controller;

use Suniland\ComunBundle\Exceptions\UsuarioNoAuthenticadoException;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\Response;

class BaseController extends Controller
{
    protected $authUser = null;

    protected function assertThatUserAuth()
    {
        $session = new Session();

        if (!$session->get('ini'))
            //|| $session->get('usuario')['id'] == 1)
            throw new UsuarioNoAuthenticadoException('User Not Login');

        if(is_null($this->authUser))
            $this->authUser = $this->em()
                ->getRepository('SunilandComunBundle:Usuario')
                ->find($session->get('usuario')['id']);
    }

    protected function em()
    {
        return $this->getDoctrine()->getManager();
    }

    protected function jsonResponse($payload, $statusCode=200)
    {
        $serializer = $this->get('serializer');

        return new Response(
            $serializer->serialize($payload, 'json'),
            $statusCode,
            ['Content-Type' => 'application/json']
        );
    }


}