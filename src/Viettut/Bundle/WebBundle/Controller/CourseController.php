<?php
/**
 * Created by PhpStorm.
 * User: giang
 * Date: 10/31/15
 * Time: 10:20 PM
 */

namespace Viettut\Bundle\WebBundle\Controller;


use FOS\RestBundle\Controller\FOSRestController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Viettut\Exception\InvalidArgumentException;
use Viettut\Model\Core\ChapterInterface;
use Viettut\Model\Core\CourseInterface;
use FOS\RestBundle\Controller\Annotations as Rest;
use Viettut\Model\User\UserEntityInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;

class CourseController extends FOSRestController
{
    /**
     * @Security("has_role('ROLE_USER')")
     *
     * @Route("/courses/create", name="create_course")
     *
     * @Template()
     */
    public function createAction()
    {
        return $this->render('ViettutWebBundle:Course:create.html.twig');
    }

    /**
     * @Security("has_role('ROLE_USER')")
     *
     * @Route("/courses/{token}/add-chapter", name="add_chapter")
     *
     * @param string $token
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @Template()
     */
    public function addChapterAction($token)
    {
        $course = $this->get('viettut.repository.course')->getCourseByToken($token);
        if(!$course instanceof CourseInterface) {
            throw new NotFoundHttpException('course not found or you do not have enough permission');
        }

        return $this->render('ViettutWebBundle:Course:addChapter.html.twig', array(
                'course' => $course
            )
        );
    }

    /**
     * @Security("has_role('ROLE_USER')")
     *
     * @Route("/courses/{token}/edit", name="course_edit")
     *
     * @param string $token
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @Template()
     */
    public function editAction($token)
    {
        $course = $this->get('viettut.repository.course')->getCourseByToken($token);
        if(!$course instanceof CourseInterface) {
            throw new NotFoundHttpException('course not found or you do not have enough permission');
        }

        return $this->render('ViettutWebBundle:Course:edit.html.twig', array(
                'course' => $course
            )
        );
    }

    /**
     * @Route("/courses/all", name="course_index")
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
            $this->get('viettut.repository.course')->getAllCourseQuery(true),
            $request->query->getInt('page', 1)/*page number*/,
            $pageSize
        );

        return $this->render('ViettutWebBundle:Course:index.html.twig', array(
            "pagination" => $pagination
        ));
    }

    /**
     * @Security("has_role('ROLE_USER')")
     *
     * @Route("/mycourses/", name="my_courses")
     *
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @Template()
     */
    public function myCoursesAction()
    {
        $user = $this->getUser();
        $courses = $this->get('viettut.repository.course')->getCourseByUser($user, $published = null);
        return $this->render('ViettutWebBundle:Course:myCourses.html.twig', array('courses' => $courses));
    }

    /**
     * present a specific guide
     *
     * @Route("/{username}/courses/{hash}", name="course_detail", requirements={"username" = "[a-z0-9]{3,}"})
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

        $course = $this->get('viettut.repository.course')->getByUserAndHash($user, $hash);

        if (!$course instanceof CourseInterface) {
            throw new NotFoundHttpException('');
        }

        if (!$course->isPublished()) {
            throw new NotFoundHttpException('');
        }

        $lastChapter = true;
        $nextChapter = $this->get('viettut.repository.chapter')->getChapterByCourseAndPosition($course, 1);
        if (!$nextChapter instanceof ChapterInterface) {
            $lastChapter = false;
        }

        $popularCourses = $this->get('viettut.repository.course')->getPopularCourse(intval($popularSize));
        $popularTutorials = $this->get('viettut.repository.tutorial')->getPopularTutorial(intval($popularSize));

        return $this->render('ViettutWebBundle:Course:detail.html.twig', array(
            'username' => $username,
            'course' => $course,
            "popularCourses" => $popularCourses,
            "popularTutorials" => $popularTutorials,
            "lastChapter" => $lastChapter,
            "nextChapter" => $nextChapter
        ));
    }

    /**
     * @Route("/courses/upload")
     * @Method({"POST"})
     *
     * @param Request $request
     * @return string
     */
    public function uploadImage(Request $request)
    {
        $uploadRootDir = $this->container->getParameter('upload_root_directory');
        $uploadDir = $this->container->getParameter('upload_directory');
        foreach ($_FILES as $file) {

            $uploadFile = new UploadedFile($file['tmp_name'], $file['name'], $file['type'], $file['size'], $file['error'], $test = false);
            $baseName = uniqid('', true);
            $uploadFile->move($uploadRootDir,
                $baseName.substr($uploadFile->getClientOriginalName(), -4)
            );

            return new JsonResponse(join('/', array($uploadDir, $baseName.substr($uploadFile->getClientOriginalName(), -4))));
        }
        throw new InvalidArgumentException('Invalid files');
    }
}