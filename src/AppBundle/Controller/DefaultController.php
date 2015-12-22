<?php

namespace AppBundle\Controller;

use AppBundle\Entity\BlockSettings;
use AppBundle\Entity\Places;
use AppBundle\Entity\Rubrics;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

use AppBundle\Entity\Stat;
use AppBundle\Entity\StatDaily;
use AppBundle\Entity\StatWeekly;
use AppBundle\Entity\StatMonthly;


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
        $place = $em->getRepository("AppBundle:Places")->find($pid);
        $rubric = $em->getRepository("AppBundle:Rubrics")->find($rid);
        $block = $em->getRepository("AppBundle:BlockSettings")->find($bid);

        $today = new \DateTime('now');

        $stat = $em->getRepository("AppBundle:Stat")->findOneBy(array(
            'place' => $pid,
            'rubric' => $rid,
            'blockSettings' => $bid,
            'createdAt' => $today
        ));
        if ( !$stat ) {
            $stat = new Stat();
            $stat->setPlace($place->getId());
            $stat->setRubric($rubric->getId());
            $stat->setBlockSettings($block);
            $stat->setClicks(0);
            $stat->setViews(1);
            $stat->setCreatedAt($today);
        } else {
            $stat->setViews( $stat->getViews() + 1);
        }
        $em->persist($stat);
        $em->flush();


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



    /**
     * @Route("/stats/{place_id}/{rubric_id}/{block_settings_id}/", name="redirect_to_url")
     */
    public function getAdsArrAction(Places $place_id, Rubrics $rubric_id, BlockSettings $block_settings_id, Request $request)
    {
        // writing statistics;
        $em = $this->getDoctrine()->getManager();

        $now = new \DateTime('now');

        $stat = $em->getRepository("AppBundle:Stat")->findOneBy(array(
            'place' => $place_id,
            'rubric' => $rubric_id,
            'blockSettings' => $block_settings_id,
            'createdAt' => $now
        ));

        if ( !$stat ) {
            $stat = new Stat();
            $stat->setPlace($place_id->getId());
            $stat->setRubric($rubric_id->getId());
            $stat->setBlockSettings($block_settings_id);
            $stat->setCreatedAt($now);
            $stat->setViews(1);
        }
        $stat->setClicks( $stat->getClicks() + 1 );

        $em->persist($stat);
        $em->flush();

        $url = $request->query->get('url');

        return $this->redirect($url);
    }


}
