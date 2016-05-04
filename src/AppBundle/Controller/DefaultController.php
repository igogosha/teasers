<?php

namespace AppBundle\Controller;

use AppBundle\Entity\BlockSettings;
use AppBundle\Entity\Places;
use AppBundle\Entity\Rubrics;
use AppBundle\Entity\User;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

use AppBundle\Entity\Stat;
use AppBundle\Entity\StatDaily;
use AppBundle\Entity\StatWeekly;
use AppBundle\Entity\StatMonthly;
use Symfony\Component\HttpKernel\Exception\HttpException;


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
        return $this->render('AppBundle:Default:teaserBlock.js.twig');
    }

    /**
     * @Route("/get-teasers.html", name="getTeasersHtml")
     */
    public function createTeaserBlockByIdsAction(Request $request)
    {
        // preparing response object
        $response = new Response(
            '',
            Response::HTTP_OK,
            array('content-type' => 'text/html')
        );

        if ( !$request->query->has('ad') ) {
            $response->setContent('no id');
            return $response;
        }

        $elements = explode('_', $request->query->get('ad'));
        if ( count($elements) < 5 ) {
            $response->setContent('wrong link. not enough arguments');
            return $response;
        }

        $rid = $elements[1];
        $gid = $elements[2];
        $pid = $elements[3];
        $bid = $elements[4];

        $em = $this->getDoctrine()->getEntityManager();

        $settings = $em->getRepository('AppBundle:BlockSettings')
            ->find($bid);
        $limit = $settings->getRows() * $settings->getCols();

        $teasers = $em->getRepository('AppBundle:Teasers')
            ->findBy(array(
                'groups' => $gid
            ), array(), $limit);


//        $place = $em->getRepository("AppBundle:Places")->find($pid);
//        $rubric = $em->getRepository("AppBundle:Rubrics")->find($rid);
//        $block = $em->getRepository("AppBundle:BlockSettings")->find($bid);
//
//        $today = new \DateTime('now');
//
//        $stat = $em->getRepository("AppBundle:Stat")->findOneBy(array(
//            'place' => $pid,
//            'rubric' => $rid,
//            'blockSettings' => $bid,
//            'createdAt' => $today
//        ));
//        if ( !$stat ) {
//            $stat = new Stat();
//            $stat->setPlace($place->getId());
//            $stat->setRubric($rubric->getId());
//            $stat->setBlockSettings($block);
//            $stat->setClicks(0);
//            $stat->setViews(1);
//            $stat->setCreatedAt($today);
//        } else {
//            $stat->setViews( $stat->getViews() + 1);
//        }
//        $em->persist($stat);
//        $em->flush();


        $content = $this->renderView('AppBundle:Default:teaserBlock.html.twig', array(
            'rid' => $rid,
            'gid' => $gid,
            'pid' => $pid,
            'bid' => $bid,
            'teasers' => $teasers,
            'settings' => $settings
        ));
        $response->setContent($content);

        return $response;
    }

    /**
     * @Route("/stats/{teasers_id}/{block_settings_id}/", name="redirect_to_url")
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

    /**
     * @Route("/html/{id}", name="teaser_html")
     */
    public function htmlAction($id, Request $request)
    {
        if ( $request->isXmlHttpRequest() ) {
            $data = $request->request->all()['appbundle_blocksettings'];

            $html = $this->renderView('AppBundle:Default:html/teaser_'.$data['blockId'].'.html.twig', $data);

            return new JsonResponse(array('success'=> true, 'content' => $html));
        }
        return $this->render('AppBundle:Default:html/teaser_'.$id.'.html.twig', array('renderButton' => true));
    }

}
