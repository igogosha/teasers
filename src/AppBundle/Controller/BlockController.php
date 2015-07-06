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
     * @Route("/admin/block/edit/{id}", name="admin_places_edit_block")
     */
    public function editAction($id)
    {
        //$block = new BlockSettings();
        $em = $this->getDoctrine()->getManager();
        $block = $em->getRepository("AppBundle:BlockSettings")
            ->find($id);

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
        $block = new BlockSettings();

        $form = $this->createForm(new BlockSettingsType(), $block);
        $form->handleRequest($request);
        if ($form->isValid()) {

            $block->setUser($this->getUser());

            $em = $this->getDoctrine()->getManager();
            $em->persist($block);
            $em->flush();

            return $this->redirectToRoute('admin_places_add_block');
        }

    }

}
