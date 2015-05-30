<?php

namespace Fran\FrontendBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class DefaultController extends Controller
{
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        $ofertas = $em->getRepository('BackendBundle:Oferta')->findBy(array('disponible'=>true));
       try{
           $dataResult = array();
           foreach ($ofertas as $oferta) {
               $dataResult[]=$oferta->NormalizedAssoc();
           }
           return new Response(json_encode($dataResult),200);
       }catch (\Exception $e)
       {
           return new Response($e->getMessage(),500);
       }
    }
}
