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
    public function uploadFilesAction()
    {

        echo '<pre>';
        print_r($_FILES['appbundle_teasers']);
        exit;

        $basePath = $this->get('kernel')->getRootDir()
            . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR . "web"
            . ($viewPath = DIRECTORY_SEPARATOR . "uploads" . DIRECTORY_SEPARATOR);
        $data['success'] = 0;

        $view = "image_preview";
        if ($this->getRequest()->get('view')) {
            $view = $this->getRequest()->get('view');
        }

        if (null !== ($field = $this->getRequest()->get('field'))) {
            $field = preg_replace("/\[\]/", "", $field);
            if (null !== ($files = $this->getRequest()->files->get($field))) {

                if (!is_array($files)) {
                    $files = array($files);
                }

                $path = $this->getRequest()->get('path', '');
                if (!preg_match("/^(.*)\/$/", $path)) {
                    $path .= DIRECTORY_SEPARATOR;
                }

                $signRename = $this->getRequest()->get('rename');
                $signPreview = $this->getRequest()->get('preview', 1);

                foreach ($files as $key => $file) {
                    $name = $file->getClientOriginalName();
                    if (null !== $signRename) {
                        $_fn = pathinfo($name, PATHINFO_FILENAME);
                        $_ext = pathinfo($name, PATHINFO_EXTENSION);
                        $name = md5($_fn . 'b1u2z3z3a3a===' . rand(10, 100)) . "." . $_ext;
                    }
                    if (file_exists($basePath . $path . $name)) {
                        if (false) {
                            /**
                             * Did not rename the file and return error
                             */
                            $data[$key]['error'] = $this->renderView(
                                'DashboardMainBundle:Upload:upload_failed.html.twig',
                                array(
                                    'message' => 'File with name "' . $name . '" already exist!'
                                )
                            );
                        } else {
                            /**
                             * Recursive file renaming
                             *
                             * @param string $_path
                             * @param string $file
                             * @param int $count
                             * @return string
                             */
                            function _checkFile($_path, $file, $count)
                            {
                                $fn = pathinfo($file, PATHINFO_FILENAME);
                                $ext = pathinfo($file, PATHINFO_EXTENSION);
                                if (!file_exists($_path . ($_n = $fn . "_" . $count . "." . $ext))) {
                                    return $_n;
                                }
                                return _checkFile($_path, $file, ++$count);
                            }

                            $name = _checkFile($basePath . $path, $name, 1);
                        }
                    }

                    if (!isset($data[$key]['error'])) {
                        if ($file->move($basePath . $path, $name)) {
                            $data[$key]['success'] = 1;
                            $data[$key]['name'] = $name;
                            $data[$key]['path'] = $this->get('templating.helper.assets')->getUrl($viewPath . ($value = $path . $name));
                            $data[$key]['value'] = $value;

                            if ($signPreview == 1) {
                                $data[$key]['preview'] = $this->renderView(
                                    'DashboardMainBundle:Upload:' . $view . '.html.twig',
                                    array(
                                        'path' => $data[$key]['path'],
                                        'value' => $value,
                                        'name' => $name
                                    )
                                );
                            }
                        }
                    }
                }
            }
        }

        if (count($files) == 1) {
            $data = $data[0];

            if ($data['success'] == 0 && !isset($data['error'])) {
                $data['error'] = $this->renderView(
                    'DashboardMainBundle:Upload:upload_failed.html.twig',
                    array(
                        'message' => 'Upload failed!'
                    )
                );
            }
        } else {
            unset($data['success']);
        }

        $response = new Response(json_encode($data));
        $response->headers->set('Content-Type', 'application/json');

        return $response;
    }


}
