<?php

namespace AppBundle\Controller;

use AppBundle\Entity\BlockSettings;
use AppBundle\Entity\User;
use AppBundle\Form\BlockSettingsType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

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
     * @Route("/admin/block/list", name="admin_places_block_list")
     */
    public function listAction()
    {
        $em = $this->getDoctrine()->getManager();
        $blocks = $em->getRepository('AppBundle:BlockSettings')
            ->findBy(array(
               "user" => $this->getUser()
            ));

        return $this->render('AppBundle:Blocks:list.html.twig', array(
            'blocks' => $blocks
        ));
    }

    /**
     * @Route("/admin/block/edit/{id}", name="admin_places_edit_block")
     */
    public function editAction(BlockSettings $blockSettings)
    {
        if ( !$blockSettings ) {
            throw new NotFoundHttpException('No block found by id');
        }

        if ( $blockSettings->getUser() !== $this->getUser() ) {
            throw new NotFoundHttpException('Oooooops! This block does not exist or does not belong to you ;)');
        }

        $em = $this->getDoctrine()->getManager();

        $form = $this->createForm(new BlockSettingsType(), $blockSettings, array(
            'action' => $this->generateUrl('admin_places_save_block'),
            'method' => 'POST',
        ));

        return $this->render('AppBundle:Blocks:edit.html.twig', array(
            'form' => $form->createView(),
            'block' => $blockSettings
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
