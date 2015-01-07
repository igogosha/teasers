<?php

namespace AppBundle\Controller;

use AppBundle\Form\RubricsType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use AppBundle\Entity\Rubrics;

class AdminController extends Controller
{
    /**
     * @Route("/admin", name="admin_home")
     */
    public function indexAction()
    {
        $test = 'test';

        return $this->render('AppBundle:Admin:index.html.twig', array(
            'test' => $test
        ));
    }

    /**
     * @Route("/admin/settings", name="admin_settings")
     */
    public function settingsAction()
    {

        $rubrics = new Rubrics();

        $form = $this->createForm(new RubricsType(), $rubrics, array(
            'action' => $this->generateUrl('admin_add_rubrics'),
            'method' => 'POST',
        ));

        return $this->render('AppBundle:Admin:settings.html.twig', array(
            'form' => $form->createView()
        ));
    }

    /**
     * @Route("/add_rubrics", name="admin_add_rubrics")
     */
    public function addRubricsAction()
    {



    }


}
