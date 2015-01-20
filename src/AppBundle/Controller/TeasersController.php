<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Teasers;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use AppBundle\Form\TeasersType;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class TeasersController extends Controller
{

    /**
     * @Route("admin/teasers/create", name="admin_create_group")
     */
    public function indexAction()
    {
        $teasers = new Teasers();
        $form = $this->createForm(new TeasersType(), $teasers, array(
            'action' => $this->generateUrl('homepage'),
            'method' => 'Post',
        ));

        return $this->render('AppBundle:Teasers:create.html.twig', array(
            'form' => $form->createView()
        ));
    }

}
