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
        $bid = $request->query->get('b');

        $em = $this->getDoctrine()->getEntityManager();

        $settings = $em->getRepository('AppBundle:BlockSettings')
            ->find($bid);
        $limit = $settings->getRows() * $settings->getCols();

        $teasers = $em->getRepository('AppBundle:Teasers')
            ->findBy(array(
                'groups' => $gid
            ), array(), $limit);

        $orderArray = array();
        $textPosition = $settings->getTextPosition();
        //$imagePosition = $settings->getTextPosition();
        $morePosition = $settings->getMorePosition();

        $moreLast = array('down', 'right_down','right_up','img_down');
        $moreSecond = array('img_up', 'left_up','left_down');
        $titleUp = array('up', 'left');
        if ( in_array($morePosition, $moreLast) ) {
            if ( $textPosition == 'up' ) {
                $orderArray = array(1,2,3);
            } else {
                $orderArray = array(2,1,3);
            }
        } elseif ( in_array($moreSecond, $moreLast) ) {
            if ( in_array($textPosition, $titleUp) ) {
                $orderArray = array(1,3,2);
            } else {
                $orderArray = array(2,3,1);
            }
        } else {
            $orderArray = array(3,2,1);
        }


        return $this->render('AppBundle:Default:teaserBlock.js.twig', array(
            'rid' => $rid,
            'gid' => $gid,
            'pid' => $pid,
            'bid' => $bid,
            'teasers' => $teasers,
            'settings' => $settings,
            'orderArray' => $orderArray
        ));
    }
}
