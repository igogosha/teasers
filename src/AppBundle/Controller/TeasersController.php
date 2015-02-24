<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Groups;
use AppBundle\Entity\Teasers;
use AppBundle\Entity\TeasersSettings;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use AppBundle\Form\TeasersType;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
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
            ->findBy(array(
                'user' => $this->getUser()
            ));


        $teasers = $em->getRepository("AppBundle:Teasers")
            ->findBy(array(
                'user' => $this->getUser()
            ));

        $teasersArray = array();
        foreach( $groups as $group ) {
            $teasersArray[$group->getId()] = array(
                'group_name' => $group->getTitle(),
                'rubric_name' => $group->getRubrics()->getName()
            );
        }

        foreach( $teasers as $teaser ) {
            $teasersArray[$teaser->getGroups()->getId()]['teasers'][] = array(
                'id' => $teaser->getId(),
                'title' => $teaser->getTitle(),
                'link' => $teaser->getLink()
            );
            $teasersArray[$teaser->getGroups()->getId()]['links'][] = $teaser->getLink();
            $teasersArray[$teaser->getGroups()->getId()]['ctr'] = 'ctr';
            $teasersArray[$teaser->getGroups()->getId()]['views'] = 'views';
        }

//        echo '<pre>';
//        print_r($teasersArray);
//        exit;

        return $this->render('AppBundle:Teasers:list.html.twig', array(
            'groups' => $teasersArray
        ));
    }

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


}
