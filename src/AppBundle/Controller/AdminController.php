<?php

namespace AppBundle\Controller;

use AppBundle\Form\RubricsType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use AppBundle\Entity\Rubrics;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

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

        $allRubrics = $rubric = $this->getDoctrine()
            ->getRepository('AppBundle:Rubrics')
            ->findBy(array(
                'user' => $this->getUser()
            ))
        ;

        return $this->render('AppBundle:Admin:settings.html.twig', array(
            'form' => $form->createView(),
            'rubrics' => $allRubrics
        ));
    }

    /**
     * @Route("/add_rubrics", name="admin_add_rubrics")
     */
    public function addRubricsAction(Request $request)
    {

        if($request->isXmlHttpRequest()) {
            $result = array();
            $rubrics = $request->request->get('newRubricName');

            $rubric = $this->getDoctrine()
                ->getRepository('AppBundle:Rubrics')
                ->findOneBy(array(
                    'name'=>$rubrics
                ));

            if ( !$rubric ) {
                $newRubric = new Rubrics();
                $newRubric->setName($rubrics);
                $newRubric->setUser($this->getUser());
                $newRubric->setCreatedAt(new \DateTime('now'));
                $newRubric->setAlias('');
                $newRubric->setGroups('');

                $em = $this->getDoctrine()->getManager();
                $em->persist($newRubric);
                $em->flush();

                $result['msg'] = $rubrics;
                $result['id'] = $newRubric->getId();

            } else {
                $result['msg'] = 'exists';
            }


            return new JsonResponse($result);

        } else {
            //return $this->redirect($this->generateUrl('your_route'));
        }

    }

    /**
     * @Route("/delete_rubrics", name="admin_delete_rubrics")
     */
    public function deleteRubricsAction(Request $request)
    {

        if($request->isXmlHttpRequest()) {
            $result = array();
            $rubricId = $request->request->get('id');

            $rubric = $this->getDoctrine()
                ->getRepository('AppBundle:Rubrics')
                ->find($rubricId);

            // check if rubric has groups attached TODO

            if ( $rubric ) {

                $em = $this->getDoctrine()->getManager();
                $em->remove($rubric);
                $em->flush();

                $result['msg'] = 'deleted';
                $result['id'] = $rubricId;

            } else {
                $result['msg'] = 'not found';
            }


            return new JsonResponse($result);

        } else {
            //return $this->redirect($this->generateUrl('your_route'));
        }

    }


}
