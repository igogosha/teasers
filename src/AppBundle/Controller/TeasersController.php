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
    public function createAction()
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

    /**
     * @Route("admin/teasers/save", name="save-teasers-path")
     */
    public function saveTeasersAction(Request $request)
    {
        $response['msg'] = false;
        if ( $request->isXmlHttpRequest() ) {
            $data = $request->request->get('data');

            if ( !empty($data) ) {
                $em = $this->getDoctrine()->getEntityManager();
                $group = $em->getRepository('AppBundle:Groups')
                    ->find($data['group']);

                if ( !$group ) {
                    $response['msg'] = 'No such group';
                    return new JsonResponse($response);
                }

                foreach( $data['images'] as $k => $img ) {
                    $teasers = new Teasers();
                    $teasers->setUser($this->getUser());
                    $teasers->setGroups($group);

                    $teasers->setImage($img);
                    $teasers->setLink($data['links'][$k]);
                    $teasers->setTitle($data['titles'][$k]);
                    $teasers->setCreatedAt( new \DateTime('now') );

                    $em->persist($teasers);
                    $em->flush();
                    $response['msg'] = 'success';

                }

            }
        } else {
            $response['msg'] = 'not ajax';
        }

        return new JsonResponse($response);

    }


}
