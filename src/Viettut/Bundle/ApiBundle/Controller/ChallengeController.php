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
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use Viettut\Exception\InvalidArgumentException;
use Viettut\Handler\HandlerInterface;
use Viettut\Model\Core\ChallengeInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Viettut\Model\Core\ChapterInterface;
use Viettut\Model\Core\CourseInterface;
use Viettut\Model\User\UserEntityInterface;

/**
 * @RouteResource("Challenge")
 */
class ChallengeController extends RestControllerAbstract implements ClassResourceInterface
{

    /**
     * Get all challenge
     *
     * @Rest\View(
     *      serializerGroups={"challenge.summary", "user.summary"}
     * )
     *
     * @ApiDoc(
     *  resource = true,
     *  statusCodes = {
     *      200 = "Returned when successful"
     *  }
     * )
     *
     * @return ChallengeInterface[]
     */
    public function cgetAction()
    {
        return $this->all();
    }

    /**
     * Get a single challenge for the given id
     *
     * @Rest\View(
     *      serializerGroups={"challenge.detail", "user.summary"}
     * )
     * @ApiDoc(
     *  resource = true,
     *  statusCodes = {
     *      200 = "Returned when successful",
     *      404 = "Returned when the resource is not found"
     *  }
     * )
     * @ApiDoc(
     *  resource = true,
     *  statusCodes = {
     *      200 = "Returned when successful",
     *      404 = "Returned when the resource is not found"
     *  }
     * )
     * @param int $id the resource id
     *
     * @return ChallengeInterface
     * @throws NotFoundHttpException when the resource does not exist
     */
    public function getAction($id)
    {
        return $this->one($id);
    }

    /**
     * @param $id
     * @return mixed
     */
    public function getTestsAction($id)
    {
        /**@var ChallengeInterface $challenge */
        $challenge = $this->one($id);

        return $this->get('viettut.repository.test')->getTestForChallenge($challenge);
    }

    /**
     * @ApiDoc(
     *  resource = true,
     *  statusCodes = {
     *      200 = "Returned when successful",
     *      404 = "Returned when the resource is not found"
     *  }
     * )
     * @param $id
     * @return mixed
     */
    public function getUnusedtestsAction($id)
    {
        /**@var ChallengeInterface $challenge */
        $challenge = $this->one($id);

        return $this->get('viettut.repository.test')->getUnusedTestForChallenge($challenge);
    }

    /**
     * Create a challenge from the submitted data
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
     * @param Request $request
     * @return JsonResponse
     * @throws InvalidArgumentException
     */
    public function postUploadAction(Request $request)
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

        $remoteService = $this->get('viettut.services.remote_service');
        foreach ($_FILES as $file) {
            $uploadFile = new UploadedFile($file['tmp_name'], $file['name'], $file['type'], $file['size'], $file['error'], $test = false);
            $fileContent = file_get_contents($uploadFile->getPath());
            $uniqueId = md5(uniqid($user->getUsername(), true));
            $data = $remoteService->putFile($fileContent, $uniqueId);
            if ($data) {
                return new JsonResponse($uniqueId);
            }

            throw new InvalidArgumentException('Invalid files');
        }

        throw new InvalidArgumentException('Invalid files');
    }

    /**
     * Update an existing challenge from the submitted data
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
     * @return string
     */
    protected function getResourceName()
    {
        return 'challenge';
    }

    /**
     * The 'get' route name to redirect to after resource creation
     *
     * @return string
     */
    protected function getGETRouteName()
    {
        return 'api_1_get_challenge';
    }

    /**
     * @return HandlerInterface
     */
    protected function getHandler()
    {
        return $this->container->get('viettut_api.handler.challenge');
    }
}