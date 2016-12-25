<?php
/**
 * Created by PhpStorm.
 * User: giang
 * Date: 10/21/15
 * Time: 10:24 PM
 */

namespace Viettut\Bundle\ApiBundle\Controller;


use FOS\RestBundle\Controller\Annotations\RouteResource;
use FOS\RestBundle\Routing\ClassResourceInterface;
use FOS\RestBundle\View\View;
use FOS\RestBundle\Controller\Annotations as Rest;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;
use Symfony\Component\Form\FormTypeInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use Viettut\Handler\HandlerInterface;
use Viettut\Model\Core\CourseInterface;
use Viettut\Model\User\UserEntityInterface;

/**
 * @RouteResource("Course")
 */
class CourseController extends RestControllerAbstract implements ClassResourceInterface
{
    /**
     * Get all ad course
     *
     * @Rest\View(
     *      serializerGroups={"course.summary", "user.summary"}
     * )
     *
     * @ApiDoc(
     *  resource = true,
     *  statusCodes = {
     *      200 = "Returned when successful"
     *  }
     * )
     *
     * @return CourseInterface[]
     */
    public function cgetAction()
    {
        return $this->all();
    }

    /**
     * Get a single adTag for the given id
     * @Rest\View(
     *      serializerGroups={"course.detail", "user.summary", "chapter.detail", "comment.summary", "coursetag.detail", "tag.detail"}
     * )
     * @ApiDoc(
     *  resource = true,
     *  statusCodes = {
     *      200 = "Returned when successful",
     *      404 = "Returned when the resource is not found"
     *  }
     * )
     *
     * @param int $id the resource id
     *
     * @return CourseInterface
     * @throws NotFoundHttpException when the resource does not exist
     */
    public function getAction($id)
    {
        return $this->one($id);
    }

    /**
     * Get all courses to which belongs the current signed user
     * @Rest\Get("/mycourses")
     *
     * @Rest\View(
     *      serializerGroups={"course.detail", "user.summary", "chapter.detail", "comment.summary"}
     * )
     * @ApiDoc(
     *  resource = true,
     *  statusCodes = {
     *      200 = "Returned when successful",
     *      404 = "Returned when the resource is not found"
     *  }
     * )
     *
     * @return CourseInterface[]
     * @throws AccessDeniedException when the resource does not exist
     */
    public function getMycoursesAction()
    {
        $lecturer = $this->getUser();
        if (!$lecturer instanceof UserEntityInterface) {
            throw new AccessDeniedException(
                sprintf(
                    'You do not have permission to view this %s or it does not exist',
                    $this->getResourceName()
                )
            );
        }

        return $this->get('viettut.domain_manager.course')->getCourseByUser($lecturer);
    }

    /**
     *
     * @Rest\View(
     *      serializerGroups={"course.detail", "user.summary", "chapter.detail"}
     * )
     * get all chapter that belong to the given course
     * @param $id
     * @return mixed
     */
    public function cgetChaptersAction($id)
    {
        $course = $this->one($id);

        $chapterManager = $this->get('viettut.domain_manager.chapter');
        return $chapterManager->getChaptersByCourse($course);
    }

    /**
     *
     * @Rest\View(
     *      serializerGroups={"course.summary", "user.summary", "comment.detail"}
     * )
     *
     * @param $id
     * @return array
     */
    public function cgetCommentsAction($id)
    {
        $course = $this->one($id);

        $commentManager = $this->get('viettut.domain_manager.comment');
        return $commentManager->getByCourse($course);
    }

    /**
     * Create a adTag from the submitted data
     *
     * @ApiDoc(
     *  resource = true,
     *  statusCodes = {
     *      200 = "Returned when successful",
     *      400 = "Returned when the submitted data has errors"
     *  }
     * )
     *
     * @param Request $request the request object
     *
     * @return FormTypeInterface|View
     */
    public function postAction(Request $request)
    {
        return $this->post($request);
    }

    /**
     * Update an existing adTag from the submitted data or create a new adTag
     *
     * @ApiDoc(
     *  resource = true,
     *  statusCodes = {
     *      201 = "Returned when the resource is created",
     *      204 = "Returned when successful",
     *      400 = "Returned when the submitted data has errors"
     *  }
     * )
     *
     * @param Request $request the request object
     * @param int $id the resource id
     *
     * @return FormTypeInterface|View
     *
     * @throws NotFoundHttpException when the resource does not exist
     */
    public function putAction(Request $request, $id)
    {
        return $this->put($request, $id);
    }

    /**
     * Update an existing adTag from the submitted data or create a new adTag at a specific location
     *
     * @ApiDoc(
     *  resource = true,
     *  statusCodes = {
     *      204 = "Returned when successful",
     *      400 = "Returned when the submitted data has errors"
     *  }
     * )
     *
     * @param Request $request the request object
     * @param int $id the resource id
     *
     * @return FormTypeInterface|View
     *
     * @throws NotFoundHttpException when resource not exist
     */
    public function patchAction(Request $request, $id)
    {
        return $this->patch($request, $id);
    }

    /**
     * Delete an existing adTag
     *
     * @ApiDoc(
     *  resource = true,
     *  statusCodes = {
     *      204 = "Returned when successful",
     *      400 = "Returned when the submitted data has errors"
     *  }
     * )
     *
     * @param int $id the resource id
     *
     * @return View
     *
     * @throws NotFoundHttpException when the resource not exist
     */
    public function deleteAction($id)
    {
        return $this->delete($id);
    }
    
    /**
     * @return string
     */
    protected function getResourceName()
    {
        return 'course';
    }

    /**
     * The 'get' route name to redirect to after resource creation
     *
     * @return string
     */
    protected function getGETRouteName()
    {
        return 'api_1_get_course';
    }

    /**
     * @return HandlerInterface
     */
    protected function getHandler()
    {
        return $this->container->get('viettut_api.handler.course');
    }
}