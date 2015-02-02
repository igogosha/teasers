<?php

namespace AppBundle\Controller;

use AppBundle\Form\RubricsType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use AppBundle\Entity\Rubrics;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\Places;
use AppBundle\Form\PlacesType;

class PlacesController extends Controller
{
    /**
     * @Route("/admin/places", name="admin_places")
     */
    public function indexAction()
    {
        $test = 'test';

        return $this->render('AppBundle:Places:index.html.twig', array(
            'test' => $test
        ));
    }


    /**
     * @Route("/admin/places/add", name="admin_places_add")
     */
    public function addPlaceAction()
    {
        $em = $this->getDoctrine()->getEntityManager();
        $places = new Places();

        $result = array();
        $form = $this->createForm(new PlacesType(), $places, array(
            'action' => $this->generateUrl('admin_places_add_save'),
            'method' => 'POST',
        ));
        $groups = $em->getRepository('AppBundle:Groups')->findBy(array(
            'user' => $this->getUser()
        ));
        $rubrics = $em->getRepository('AppBundle:Rubrics')->findBy(array(
            'user' => $this->getUser()
        ));

        foreach( $rubrics as $r ) {
            $result[$r->getId()] = array(
                'rubric_id' => $r->getId(),
                'rubric_name' => $r->getName()
            );
        }

        foreach( $groups as $k => $g ) {
            $r_id = $g->getRubrics()->getId();

            if ( $g->getId() ) {
                $result[$r_id]['groups'][$g->getId()] = array(
                    'id' => $g->getId(),
                    'name' => $g->getTitle()
                );
            } else {
                $result[$r_id]['groups'] = array();
            }
        };

        return $this->render('AppBundle:Places:addPlace.html.twig', array(
            'form' => $form->createView(),
            'rubrics' => $result
        ));
    }

    /**
     * @Route("/admin/places/add/save", name="admin_places_add_save")
     */
    public function addSavePlaceAction()
    {
       echo '<pre>';
        print_r(777);
        exit;
    }


}
