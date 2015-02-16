<?php

namespace AppBundle\Controller;

use AppBundle\Entity\BlockSettings;
use AppBundle\Form\BlockSettingsType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class BlockController extends Controller
{
    /**
     * @Route("/admin/block/add", name="admin_places_add_block")
     */
    public function indexAction()
    {
        $block = new BlockSettings();

        $form = $this->createForm(new BlockSettingsType(), $block, array(
            'action' => $this->generateUrl('admin_places_save_block'),
            'method' => 'POST',
        ));

        return $this->render('AppBundle:Blocks:add.html.twig', array(
            'form' => $form->createView()
        ));
    }


    /**
     * @Route("/admin/block/save", name="admin_places_save_block")
     */
    public function saveBlockAction(Request $request)
    {
        $result = array();
        if ( $request->isXmlHttpRequest() ) {

            $result['msg'] = 'success';

        }

        return new JsonResponse($result);

    }

}
