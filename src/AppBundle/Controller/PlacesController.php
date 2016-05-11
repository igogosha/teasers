<?php

namespace AppBundle\Controller;

use AppBundle\Entity\GroupToPlace;
use AppBundle\Form\RubricsType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use AppBundle\Entity\Rubrics;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\Places;
use AppBundle\Form\PlacesType;
use Symfony\Component\Validator\Constraints\DateTime;


class PlacesController extends Controller
{
    /**
     * @Route("/admin/places", name="admin_places")
     */
    public function indexAction()
    {
        $groupsPlace = $this->getDoctrine()->getRepository('AppBundle:GroupToPlace')
            ->findBy(array(
                'user' => $this->getUser()
            ));

        $places = array();
        $placesIds = array();
        foreach( $groupsPlace as $gp ) {

            $placesIds[] = $gp->getPlaces()->getId();

            $places[$gp->getPlaces()->getId()]['name'] = $gp->getPlaces()->getName();
            $places[$gp->getPlaces()->getId()]['row'][]  = array(
                'g_id' => $gp->getGroups()->getId(),
                'g_name' => $gp->getGroups()->getTitle(),
                'r_id' => $gp->getGroups()->getRubrics()->getId(),
                'r_name' => $gp->getGroups()->getRubrics()->getName(),
            );
        }

        $blocks = $this->getDoctrine()->getRepository('AppBundle:BlockSettings')
            ->findBy(array(
                'user' => $this->getUser()
            ));

        $blocksToPlaces = $this->getDoctrine()->getRepository('AppBundle:BlockToPlace')
            ->findBy(array(
                'place' => $placesIds
            ));

        foreach($blocksToPlaces as $block) {
            $places[$block->getPlace()->getId()]['blocks'][$block->getGroup()->getId()][$block->getRubric()->getId()][] = array(
               'id' =>  $block->getBlock()->getId(),
                'name' => $block->getBlock()->getBlockName(),
                'ctr' => 5 * $block->getId()
            );
        }

        return $this->render('AppBundle:Places:index.html.twig', array(
            'places' => $places,
            'blocks' => $blocks
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
    public function addSavePlaceAction(Request $request)
    {
        $response = array();
        if ( $request->isXmlHttpRequest() ) {

            $name = $request->request->get('name');

            if ( empty($name) ) {
                $response['msg'] = 'error';
            } else {
                $rubrics = $request->request->get('rubrics');
                $em = $this->getDoctrine()->getEntityManager();
                $place = $this->getDoctrine()->getRepository('AppBundle:Places')
                    ->findOneBy(array(
                        'name' => $name
                    ));
                if (!$place) {
                    $place = new Places();
                    $place->setName($name);
                    $place->setUser($this->getUser());
                    $place->setCreatedAt(new \DateTime('now'));

                    $em->persist($place);
                    $em->flush();
                }

                foreach ($rubrics as $r) {
                    foreach ($r as $g) {
                        $group = $this->getDoctrine()->getRepository('AppBundle:Groups')
                            ->find($g);

                        $r_to_g = new GroupToPlace();
                        $r_to_g->setGroups($group);
                        $r_to_g->setUser($this->getUser());
                        $r_to_g->setPlaces($place);
                        $r_to_g->setCreatedAt(new \DateTime('now'));

                        $em->persist($r_to_g);
                        $em->flush();
                    }
                }
                $response['success'] = true;
                $response['redirect_link'] = $this->generateUrl('admin_places');
            }

        } else {
            $response['msg'] = 'not ajax';
        }

        return new JsonResponse($response);
    }

    /**
     * @Route("/admin/places/get-embed-code", name="admin_places_get_embed_code")
     */
    public function getEmbedCodeAction(Request $request)
    {
        $resp = array();

        if ( $request->isXmlHttpRequest() ) {
            $data = $request->request->all();

            $gid = $data['gid'];
            $rid = $data['rid'];
            $pid = $data['pid'];
            $bid = $data['bid'];
            $template = $this->renderView('AppBundle:Places:embedCode.html.twig', array(
                'gid' => $gid,
                'rid' => $rid,
                'pid' => $pid,
                'bid' => $bid,
            ));

            $resp['content'] = $template;
            $resp['msg'] = 'success';


//            echo '<pre>';
//            print_r($data);
//            exit;

        } else {
            $resp['msg'] = 'not ajax';
        }

        return new JsonResponse($resp);
    }

    /**
     * @Route("/admin/places/rename", name="admin_places_rename")
     */
    public function renamePlaceAction(Request $request)
    {
        $resp = array();
        if ( $request->isXmlHttpRequest() ) {
            $id = $request->request->getInt('id');
            $name = $request->request->get('name');

            $em = $this->getDoctrine()->getEntityManager();
            $place = $em->getRepository("AppBundle:Places")->find($id);

            if ( $place ) {
                $place->setName($name);

                $em->persist($place);
                $em->flush();

                $resp['success'] = true;

            } else {
                $resp['success'] = false;
                $resp['msg'] = 'nothing found by id';
            }

        } else {
            $resp['msg'] = 'not ajax';
        }

        return new JsonResponse($resp);
    }


}
