<?php

namespace AppBundle\Controller;

use AppBundle\Form\RubricsType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use AppBundle\Entity\Rubrics;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

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

        $allRubrics = $rubric = $this->getDoctrine()
            ->getRepository('AppBundle:Rubrics')
            ->findBy(array(
                'user' => $this->getUser()
            ));

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

        echo '<pre>';
        print_r($files[0]->getFileName());
        exit;

        $target_dir = $this->get('kernel')->getRootDir()
            . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR . "web"
            . ($viewPath = DIRECTORY_SEPARATOR . "uploads" . DIRECTORY_SEPARATOR);
        $data['success'] = 0;

        $file = $_FILES['pictures'];
//        echo '<pre>';
//        print_r($file);
//        exit;

        $target_file = $target_dir . md5( basename($file["name"][0] . '' ));
        $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);

        $check = getimagesize($file["tmp_name"][0]);
        if($check !== false) {

            if (file_exists($target_file)) {
                $data['msg'] = "exists";
            }
            if ($file["size"][0] > 500000) {
                $data['msg'] = "too large";
            }
            if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
                && $imageFileType != "gif" ) {
                $data['msg'] = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
            }

            if (move_uploaded_file($file["tmp_name"][0], $target_file)) {
                $data['msg'] = "The file ". basename( $file["name"][0]). " has been uploaded.";
            } else {
                $data['msg'] = "Sorry, there was an error uploading your file.";
            }

        } else {
            $data['msg'] = "not image";
        }

//        if (count($files) == 1) {
//            $data = $data[0];
//
//            if ($data['success'] == 0 && !isset($data['error'])) {
//                $data['error'] = $this->renderView(
//                    'DashboardMainBundle:Upload:upload_failed.html.twig',
//                    array(
//                        'message' => 'Upload failed!'
//                    )
//                );
//            }
//        } else {
//            unset($data['success']);
//        }

        $response = new Response(json_encode($data));
        $response->headers->set('Content-Type', 'application/json');

        return $response;
    }


}
