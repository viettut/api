<?php
/**
 * Created by PhpStorm.
 * User: giang
 * Date: 10/21/15
 * Time: 10:24 PM
 */

namespace Viettut\Bundle\ApiBundle\Controller;


use DateTime;
use FOS\RestBundle\Controller\Annotations\RouteResource;
use FOS\RestBundle\Routing\ClassResourceInterface;
use FOS\RestBundle\View\View;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;
use Symfony\Component\Form\FormTypeInterface;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use Viettut\Exception\InvalidArgumentException;
use Viettut\Handler\HandlerInterface;
use FOS\RestBundle\Controller\Annotations as Rest;
use Viettut\Model\Core\TutorialInterface;
use Viettut\Model\User\UserEntityInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

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
     * @Route("/tutorials/upload")
     * @Method({"POST"})
     *
     * @param Request $request
     * @return string
     */
    public function uploadFile(Request $request)
    {
        $user = $this->getUser();
        if (!$user instanceof UserEntityInterface) {
            throw new AccessDeniedException(
                sprintf(
                    'You do not have permission to view this %s or it does not exist',
                    $this->getResourceName()
                )
            );
        }
        $today = (new DateTime())->format('Y-m-d');
        $uploadRootDir = $this->container->getParameter('upload_root_directory');
        $uploadDir = $this->container->getParameter('upload_directory');
        foreach ($_FILES as $file) {

            $uploadFile = new UploadedFile($file['tmp_name'], $file['name'], $file['type'], $file['size'], $file['error'], $test = false);
            $baseName = uniqid('', true);
            $uploadFile->move($uploadRootDir,
                $baseName.substr($uploadFile->getClientOriginalName(), -4)
            );

            return new JsonResponse(join('/', array($uploadDir, $user->getUsername(), $today, $baseName.substr($uploadFile->getClientOriginalName(), -4))));
        }
        throw new InvalidArgumentException('Invalid files');
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