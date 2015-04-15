<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction()
    {
        return $this->render('default/index.html.twig');
    }

    /**
     * @Route("/getTeasers/{id}", name="getTeasers")
     */
    public function createTeaserBlockAction($id)
    {
        $response = new Response($this->renderView('AppBundle:Default:teaserBlock.html.twig', array(
            'id' => $id
        )));
        $response->headers->set('Content-Type', 'application/javascript');
        return $response;
    }
}
