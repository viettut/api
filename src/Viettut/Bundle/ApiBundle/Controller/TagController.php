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
use Nelmio\ApiDocBundle\Annotation\ApiDoc;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Viettut\Handler\HandlerInterface;
use Viettut\Model\Core\TagInterface;
use FOS\RestBundle\Controller\Annotations as Rest;

/**
 * @RouteResource("Tag")
 */
class TagController extends RestControllerAbstract implements ClassResourceInterface
{
    /**
     * Get all ad tags
     * @Rest\View(
     *      serializerGroups={"tag.summary"}
     * )
     * @ApiDoc(
     *  resource = true,
     *  statusCodes = {
     *      200 = "Returned when successful"
     *  }
     * )
     *
     * @return TagInterface[]
     */
    public function cgetAction()
    {
        return $this->all();
    }

    /**
     *
     * Get a single tag for the given id
     * @Rest\View(
     *      serializerGroups={"tag.detail"}
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
     * @return TagInterface
     * @throws NotFoundHttpException when the resource does not exist
     */
    public function getAction($id)
    {
        return $this->one($id);
    }
    
    /**
     * @return string
     */
    protected function getResourceName()
    {
        return 'tag';
    }

    /**
     * The 'get' route name to redirect to after resource creation
     *
     * @return string
     */
    protected function getGETRouteName()
    {
        return 'api_1_get_tag';
    }

    /**
     * @return HandlerInterface
     */
    protected function getHandler()
    {
        return $this->container->get('viettut_api.handler.tag');
    }
}