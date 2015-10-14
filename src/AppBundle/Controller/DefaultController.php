<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
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
     * @Route("/getAdsArr", name="getAdsArr")
     */
    public function getAdsArrAction()
    {

        $r = array(
            "one",
            "two",
            "three"
        );

        return new JsonResponse($r);
    }

    /**
     * @Route("/getAdsStr", name="getAdsStr")
     */
    public function getAdsStrAction()
    {
        return new Response("returned string");
    }

    /**
     * @Route("/get-teasers.js", name="getTeasers")
     */
    public function createTeaserBlockAction(Request $request)
    {

        $rid = $request->query->get('r');
        $gid = $request->query->get('g');
        $pid = $request->query->get('p');

        $this->getDoctrine()->getEntityManager();

        return $this->render('AppBundle:Default:teaserBlock.js.twig', array(
            'id' => $request->query->get('$rid')
        ));
    }
}
