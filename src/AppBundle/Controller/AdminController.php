<?php

namespace AppBundle\Controller;

use AppBundle\Form\RubricsType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use AppBundle\Entity\Rubrics;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use AppBundle\Entity\BlockToPlace;
use AppBundle\Entity\BlockToPlaceRepository;

class AdminController extends Controller
{
    /**
     * @Route("/admin", name="admin_home")
     */
    public function indexAction()
    {
        return $this->render('AppBundle:Admin:index.html.twig');
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

        $allRubrics = $this->getDoctrine()
            ->getRepository('AppBundle:Rubrics')
            ->findBy(array(
                'user' => $this->getUser()
            ));

        $r = array();
        foreach( $allRubrics as $rubric ) {
            $r[$rubric->getId()] = array(
                'id' => $rubric->getId(),
                'name' => $rubric->getName(),
                'groups' => array()
            );
        }

        $allGroups = $this->getDoctrine()
            ->getRepository('AppBundle:Groups')
            ->findBy(array(
                'user' => $this->getUser(),
                'rubrics' => array_keys($r)
            ));

        foreach( $allGroups as $group ) {
            $r[$group->getRubrics()->getId()]['groups'][] = $group->getTitle();
        }

        return $this->render('AppBundle:Admin:settings.html.twig', array(
            'form' => $form->createView(),
            'rubrics' => $r
        ));
    }

    /**
     * @Route("/add_rubrics", name="admin_add_rubrics")
     */
    public function addRubricsAction(Request $request)
    {

        if ($request->isXmlHttpRequest()) {
            $result = array();
            $rubrics = $request->request->get('newRubricName');

            $rubric = $this->getDoctrine()
                ->getRepository('AppBundle:Rubrics')
                ->findOneBy(array(
                    'name' => $rubrics
                ));

            if (!$rubric) {
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
     * @Route("/add_block_to_place", name="admin_add_block_to_place")
     */
    public function addBlockToPlaceAction(Request $request)
    {
        $resp = array();
        if ($request->isXmlHttpRequest()) {

            $data = $request->request->all();

            $block = $this->getDoctrine()
                ->getRepository('AppBundle:BlockSettings')
                ->find((int)$data['blockId']);
            $place = $this->getDoctrine()
                ->getRepository('AppBundle:Places')
                ->find((int)$data['placeId']);
            $group = $this->getDoctrine()
                ->getRepository('AppBundle:Groups')
                ->find((int)$data['gId']);
            $rubric = $this->getDoctrine()
                ->getRepository('AppBundle:Rubrics')
                ->find((int)$data['rId']);

            $blockToPlace = $this->getDoctrine()
                ->getRepository('AppBundle:BlockToPlace')
                ->findOneBy(array(
                    'block' => $block,
                    'place' => $place,
                    'rubric' => $rubric,
                    'group' => $group,
                ));

            if ( !$blockToPlace ) {
                $blockToPlace = new BlockToPlace();
                $blockToPlace->setBlock($block);
                $blockToPlace->setPlace($place);
                $blockToPlace->setGroup($group);
                $blockToPlace->setRubric($rubric);
                $blockToPlace->setCreatedAt(new \DateTime('now'));

                $em = $this->getDoctrine()->getEntityManager();
                $em->persist($blockToPlace);
                $em->flush();
            }


            $resp['msg'] = 'success';
            $resp['tr'] = $place->getId() . '-' . $group->getId() . '-' . $rubric->getId();
            $resp['blockName'] = $block->getBlockName();
        } else {
            $resp['msg'] = 'Not ajax!';
        }

        return new JsonResponse($resp);

    }

    /**
     * @Route("/rename-rubrics", name="admin_update_rubrics_name")
     */
    public function renameRubricsAction(Request $request)
    {
        $result = array();
        if ($request->isXmlHttpRequest()) {
            $id = $request->request->get('id');
            $newName = $request->request->get('newName');
            $em = $this->getDoctrine()->getEntityManager();

            $rubric = $this->getDoctrine()
                ->getRepository('AppBundle:Rubrics')
                ->find($id);

            if ( $rubric ) {
                $rubric->setName($newName);
                $em->persist($rubric);
                $em->flush();

                $result['msg'] = 'success';
            } else {
                $result['msg'] = 'error';
            }

        } else {
            $result['msg'] = 'not ajax';
        }

        return new JsonResponse($result);
    }

    /**
     * @Route("/delete_rubrics", name="admin_delete_rubrics")
     */
    public function deleteRubricsAction(Request $request)
    {

        if ($request->isXmlHttpRequest()) {
            $result = array();
            $rubricId = $request->request->get('id');

            $rubric = $this->getDoctrine()
                ->getRepository('AppBundle:Rubrics')
                ->find($rubricId);

            // check if rubric has groups attached TODO

            if ($rubric) {

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

    /**
     * @Route("/upload-files", name="upload_files")
     */
    public function uploadFilesAction(Request $request)
    {
        $files = $request->files->get('pictures');

        $tempName = $files[0]->getFileName();
        $tempPath = $files[0]->getPathName();
        $origName = $files[0]->getClientOriginalName();
        $curSize = $files[0]->getSize();
        $mimeType = $files[0]->getMimeType();
        $error = $files[0]->getError();

        $file = new UploadedFile($tempPath, $origName, $mimeType, $curSize, $error, false);
        $ext = $file->guessExtension();


        $target_dir = $this->get('kernel')->getRootDir()
            . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR . "web"
            . ($viewPath = DIRECTORY_SEPARATOR . "uploads" . DIRECTORY_SEPARATOR . "teasers" . DIRECTORY_SEPARATOR . $this->getUser()->getId() . DIRECTORY_SEPARATOR);

        $type = explode('.', $origName);
        $imageFileType = $type[1];
        $target_file = md5( basename($tempName . '' )) . "." . $imageFileType;

        if ( $file->move($target_dir, $target_file) ) {

            $newFile = $target_file;

            $data['msg'] = "success";
            $data['thumb'] = $this->renderView('AppBundle:Teasers:preview.html.twig', array(
                'user_id' => $this->getUser()->getId(),
                'image_src' => $newFile
            ));
        } else {
            $data['msg'] = "There was a problem uploading the file";
        }

        $response = new Response(json_encode($data));
        $response->headers->set('Content-Type', 'application/json');

        return $response;
    }

    /**
     * @Route("/delete-files", name="delete_files")
     */
    public function deleteFilesAction(Request $request)
    {
        $data['msg'] = 'error';
        if ( $request->isXmlHttpRequest() ) {

            $target_dir = $this->get('kernel')->getRootDir()
                . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR . "web"
                . ($viewPath = DIRECTORY_SEPARATOR . "uploads" . DIRECTORY_SEPARATOR . "teasers" . DIRECTORY_SEPARATOR . $this->getUser()->getId() . DIRECTORY_SEPARATOR);
            $name = $request->request->get('name');
            if ( $name ) {
                if( unlink($target_dir . $name) )
                    $data['msg'] = 'success';
            }

        }

        return $data;
    }


}
