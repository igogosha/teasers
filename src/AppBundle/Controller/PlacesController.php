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
        $places = new Places();

        $places = $this->createForm(new PlacesType(), $places, array(
            'action' => $this->generateUrl('admin_places_add_save'),
            'method' => 'POST',
        ));

        return $this->render('AppBundle:Places:addPlace.html.twig', array(
            'form' => $places->createView()
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
