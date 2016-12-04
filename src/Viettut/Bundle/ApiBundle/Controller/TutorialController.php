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
use Nelmio\ApiDocBundle\Annotation\ApiDoc;
use Symfony\Component\Form\FormTypeInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Viettut\Handler\HandlerInterface;
use FOS\RestBundle\Controller\Annotations as Rest;
use Viettut\Model\Core\TutorialInterface;

/**
 * @RouteResource("Tutorial")
 */
class TutorialController extends RestControllerAbstract implements ClassResourceInterface
{
    /**
     * Get all tutorial
     *
     * @Rest\View(
     *      serializerGroups={"tutorial.summary", "user.summary"}
     * )
     *
     * @ApiDoc(
     *  resource = true,
     *  statusCodes = {
     *      200 = "Returned when successful"
     *  }
     * )
     *
     * @return TutorialInterface[]
     */
    public function cgetAction()
    {
        return $this->all();
    }

    /**
     * Get a single tutorial for the given id
     *
     * @Rest\View(
     *      serializerGroups={"tutorial.detail", "user.summary", "comment.summary"}
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
     * @return TutorialInterface
     * @throws NotFoundHttpException when the resource does not exist
     */
    public function getAction($id)
    {
        return $this->one($id);
    }

    /**
     *
     * @Rest\View(
     *      serializerGroups={"tutorial.summary", "user.summary", "comment.detail"}
     * )
     * @param $id
     * @return mixed
     */
    public function cgetCommentsAction($id)
    {
        $tutorial = $this->one($id);

        $commentManager = $this->get('viettut.domain_manager.comment');
        return $commentManager->getByTutorial($tutorial);
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
     * @return string
     */
    protected function getResourceName()
    {
        return 'tutorial';
    }

    /**
     * The 'get' route name to redirect to after resource creation
     *
     * @return string
     */
    protected function getGETRouteName()
    {
        return 'api_1_get_tutorial';
    }

    /**
     * @return HandlerInterface
     */
    protected function getHandler()
    {
        return $this->container->get('viettut_api.handler.tutorial');
    }
}