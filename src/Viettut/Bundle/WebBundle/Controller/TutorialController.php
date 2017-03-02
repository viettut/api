<?php
/**
 * Created by PhpStorm.
 * User: giang
 * Date: 10/31/15
 * Time: 10:20 PM
 */

namespace Viettut\Bundle\WebBundle\Controller;


use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Viettut\Exception\InvalidArgumentException;
use Viettut\Model\Core\TutorialInterface;
use FOS\RestBundle\Controller\Annotations as Rest;
use Viettut\Model\User\UserEntityInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;

class TutorialController extends Controller
{
    /**
     * @Security("has_role('ROLE_USER')")
     *
     * @Route("/tutorials/create", name="create_tutorial")
     *
     * @Template()
     */
    public function createAction()
    {
        return $this->render('ViettutWebBundle:Tutorial:create.html.twig');
    }

    /**
     * @Route("/tutorials/all", name="tutorial_index")
     *
     * @param $request
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @Template()
     */
    public function indexAction(Request $request)
    {
        $pageSize = $this->getParameter('page_size');

        $pagination = $this->get('knp_paginator')->paginate(
            $this->get('viettut.repository.tutorial')->getAllTutorialQuery(),
            $request->query->getInt('page', 1)/*page number*/,
            $pageSize
        );

        return $this->render('ViettutWebBundle:Tutorial:index.html.twig', array(
            "pagination" => $pagination
        ));
    }

    /**
     * @Security("has_role('ROLE_USER')")
     *
     * @Route("/lecturer/tutorials/mytutorials")
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @Template()
     */
    public function myTutorialsAction()
    {
        $user = $this->getUser();

        if (!$user instanceof UserEntityInterface) {
            $this->redirectToRoute('fos_user_security_login');
        }

        $courses = $this->get('viettut.repository.course')->getCourseByUser($user);
        return $this->render('ViettutWebBundle:Course:index.html.twig', array('courses' => $courses));
    }


    /**
     * present a specific guide
     *
     * @Route("/{username}/tutorials/{hash}", name="tutorial_detail", requirements={"username" = "[a-z0-9]{3,}"})
     *
     * @param $username
     * @param $hash
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @Template()
     */
    public function detailAction($username, $hash)
    {
        $popularSize = $this->container->getParameter('popular_size');
        $user = $this->get('viettut_user.domain_manager.lecturer')->findUserByUsernameOrEmail($username);
        if (!$user instanceof UserEntityInterface) {
            throw new NotFoundHttpException(
                sprintf("The resource was not found or you do not have access")
            );
        }

        $tutorial = $this->get('viettut.repository.tutorial')->getByUserAndHash($user, $hash);
        if(!$tutorial instanceof TutorialInterface) {
            throw new NotFoundHttpException('');
        }

        $tutorialManager = $this->get('viettut.domain_manager.tutorial');
        $tutorial->increaseView();
        $tutorialManager->save($tutorial);
        $popularCourses = $this->get('viettut.repository.course')->getPopularCourse(intval($popularSize));
        $popularTutorials = $this->get('viettut.repository.tutorial')->getPopularTutorial(intval($popularSize));

        return $this->render('ViettutWebBundle:Tutorial:detail.html.twig', array(
                'username' => $username,
                'tutorial' => $tutorial,
                "popularCourses" => $popularCourses,
                "popularTutorials" => $popularTutorials
            )
        );
    }

}