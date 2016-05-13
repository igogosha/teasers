<?php

namespace AppBundle\Controller;

use AppBundle\Entity\BlockSettings;
use AppBundle\Entity\Places;
use AppBundle\Entity\Rubrics;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

use AppBundle\Entity\Stat;
use AppBundle\Entity\StatDaily;
use AppBundle\Entity\StatWeekly;
use AppBundle\Entity\StatMonthly;

class StatisticsController extends Controller
{
    /**
     * @Route("/statistics", name="stats_main")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        $blocks = $em->getRepository('AppBundle:BlockSettings')->getStatsForUser($this->getUser());

        $stats = $em->getRepository('AppBundle:Stat')->getStatForBlocks(array_keys($blocks));

        echo '<pre>';
        print_r($stats);
        exit;

        return array(
            'blocks' => $blocks
        );
    }

}
