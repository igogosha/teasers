<?php

namespace AppBundle\Controller;

use AppBundle\Entity\BlockSettings;
use AppBundle\Entity\Places;
use AppBundle\Entity\Rubrics;
use AppBundle\Entity\Teasers;
use AppBundle\Entity\User;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\DomCrawler\Crawler;
use Symfony\Component\Finder\Finder;
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

        $crawler = new Crawler();

        $xmlDir = $this->get('kernel')->getRootDir() . '/../web' . $this->container->get('templating.helper.assets')->getUrl('/uploads/xmls/');

        $finder = new Finder();
        foreach($finder->files()->in($xmlDir) as $file) {
            $xml = simplexml_load_string($file->getContents());

            foreach( $xml->children() as $child ) {

                echo '<pre>';
                foreach($child as $key => $value) {
                    print_r($key);
                    print_r($value);
                }
            }
        }
        exit;

        $em = $this->getDoctrine()->getManager();

        $someUser = $em->getRepository("AppBundle:User")->find(1);

       return $this->render('default/index.html.twig', array(
           'someUser' => $someUser
       ));
    }


    /**
     * @Route("/get-teasers.js", name="getTeasers")
     */
    public function createTeaserBlockAction()
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
            array('content-type' => 'text/html',
                'Access-Control-Allow-Origin' => '*')
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
        $pid = $elements[2];
        $gid = $elements[3];
        $bid = $elements[4];

        $em = $this->getDoctrine()->getEntityManager();

        $settings = $em->getRepository('AppBundle:BlockSettings')
            ->find($bid);
        $limit = $settings->getRows() * $settings->getCols();

        $place = $em->getRepository("AppBundle:Places")->find($pid);
        $rubric = $em->getRepository("AppBundle:Rubrics")->find($rid);
        $block = $em->getRepository("AppBundle:BlockSettings")->find($bid);
        $group = $em->getRepository("AppBundle:Groups")->find($gid);
        $today = new \DateTime('now');

        // return empty response if group is not visible
        if ( !$group->getVisible() ) {
            $response->setContent('');
            return $response;
        }

        $teasers = $em->getRepository('AppBundle:Teasers')
            ->getRandomWithLimit($group, $limit);

        foreach( $teasers as $teaser ) {
            $stat = $em->getRepository("AppBundle:Stat")->findOneBy(array(
                'place' => $place,
                'rubric' => $rubric,
                'blockSettings' => $settings,
                'teasers' => $teaser,
                'createdAt' => $today
            ));

            if ( !$stat ) {
                $stat = new Stat();
                $stat->setPlace($place->getId());
                $stat->setRubric($rubric->getId());
                $stat->setTeasers($teaser);
                $stat->setBlockSettings($settings);
                $stat->setCreatedAt($today);
                $stat->setViews(0);
                $stat->setClicks(0);
            } else {
                $stat->setViews($stat->getViews() + 1);
            }

            $em->persist($stat);
            $em->flush();
        }

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
     * @Route("/stats/{place}/{rubric}/{block_settings}/{teaser}", name="redirect_to_url")
     */
    public function getAdsArrAction(Places $place, Rubrics $rubric, BlockSettings $block_settings, Teasers $teaser, Request $request)
    {

        // writing statistics;
        $em = $this->getDoctrine()->getManager();

        $now = new \DateTime('now');

        $stat = $em->getRepository("AppBundle:Stat")->findOneBy(array(
            'place' => $place,
            'rubric' => $rubric,
            'blockSettings' => $block_settings,
            'teasers' => $teaser,
            'createdAt' => new \DateTime("now")
        ));
        /** @var Stat $stat */
        if ( !$stat ) {
            $stat = new Stat();
            $stat->setPlace($place->getId());
            $stat->setRubric($rubric->getId());
            $stat->setTeasers($teaser);
            $stat->setBlockSettings($block_settings);
            $stat->setCreatedAt($now);
            $stat->setViews(1);
        } else {
            $stat->setClicks($stat->getClicks() + 1);
        }
        $em->persist($stat);
        $em->flush();

        $url = $teaser->getLink();

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
