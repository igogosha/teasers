<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Groups;
use AppBundle\Entity\Teasers;
use AppBundle\Entity\TeasersSettings;
use AppBundle\Form\SingleType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use AppBundle\Form\TeasersType;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Annotation\Route;


class TeasersController extends Controller
{

    /**
     * @Route("/admin/teasers", name="teasers")
     */
    public function listTeasersAction(Request $request)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $groups = $em->getRepository("AppBundle:Groups")
            ->byUserIndexedByGroupIds($this->getUser());

        $allTeasers = $em->getRepository("AppBundle:Teasers")->idsByGroups(array_keys($groups));

        $teasers = [];
        foreach( $allTeasers as $teaser ) {
            $teasers[$teaser->getGroups()->getId()][] = $teaser;
        }

        return $this->render('AppBundle:Teasers:list.html.twig', array(
            'groups' => $groups,
            'teasers' => $teasers
        ));
    }

    /**
     * @Route("admin/teasers/create", name="admin_create_group")
     */
    public function createAction()
    {
        $teasers = new Teasers();
        $form = $this->createForm(new TeasersType($this->getUser(), $this->getDoctrine()->getManager()), $teasers, array(
            'action' => $this->generateUrl('homepage'),
            'method' => 'Post',
        ));

        return $this->render('AppBundle:Teasers:create.html.twig', array(
            'form' => $form->createView()
        ));
    }

    /**
     * @Route("admin/teasers/edit/{id}", name="admin_edit_teaser")
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();
        $teasers = $em->getRepository('AppBundle:Teasers')
            ->findOneBy(array(
                'id' => $id
            ));

        exit;

        $form = $this->createForm(new TeasersType(), $teasers, array(
            'action' => $this->generateUrl('homepage'),
            'method' => 'Post',
        ));

        return $this->render('AppBundle:Teasers:create.html.twig', array(
            'form' => $form->createView()
        ));
    }

    /**
     * @Route("admin/teasers/get-teaser-form/{id}", name="admin_get_teaser_form")
     */
    public function getSingleFormAction(Request $request, Teasers $teaser)
    {
        if ( $request->isXmlHttpRequest() ) {
            if ( !$teaser ) {
                return new JsonResponse(array('error'=>2));
            }

            $form = $this->createForm(new SingleType(), $teaser, array(
                'action' => $this->generateUrl('admin_get_teaser_form', array('id' => $teaser->getId())),
                'method' => 'POST'
            ));

            $form->handleRequest($request);

            if ( $form->isSubmitted() && $form->isValid() ) {
                $em = $this->getDoctrine()->getEntityManager();
                $em->persist($teaser);

                $em->flush();
                return new JsonResponse(array(
                    'success'=>true,
                    'title' => $teaser->getTitle(),
                    'link' => $teaser->getLink(),
                    'visible' => $teaser->getVisible()
                ));
            }

            return new JsonResponse(array(
                'success' => true,
                'form' => $this->renderView('AppBundle:Teasers:singleTeaserFrom.html.twig', array(
                    'form' => $form->createView(),
                    'teaser' => $teaser
                    )
                )
            ));
        }
        else
            return new JsonResponse(array('error' => 3));
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
                $rubrics = $em->getRepository('AppBundle:Rubrics')
                    ->findOneBy(array(
                        'id' => $data['rubrics']
                    ));

                if ( !$rubrics ) {
                    $response['msg'] = 'No such group';
                    return new JsonResponse($response);
                }

                $groupTitle = $data['name'];
                $group = new Groups();
                $group->setTitle($groupTitle);
                $group->setCreatedAt(new \DateTime('now'));
                $group->setUser($this->getUser());
                $group->setRubrics($rubrics);
                $em->persist($group);
                $em->flush();

                foreach( $data['images'] as $k => $img ) {
                    $teasers = new Teasers();
                    $teasers->setUser($this->getUser());
                    $teasers->setRubrics($rubrics);
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


    /**
     * @Route("admin/teasers/on-off/{id}", name="group-on-off")
     */
    public function onOffTeasersAction(Groups $group)
    {
        if ( !$group ) {
            throw new NotFoundHttpException('No group found by id');
        }

        $em = $this->getDoctrine()->getManager();

        $group->setVisible(!$group->getVisible());
        $em->persist($group);

        $em->flush();

        return $this->redirect($this->generateUrl('teasers'));
    }
}
