<?php
/**
 * Created by PhpStorm.
 * User: giang
 * Date: 10/21/15
 * Time: 10:24 PM
 */

namespace Viettut\Bundle\ApiBundle\Controller;


use FOS\RestBundle\Controller\Annotations\RouteResource;
use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\View\View;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;
use Symfony\Component\Form\FormTypeInterface;
use Symfony\Component\HttpFoundation\Request;
use Viettut\Entity\Core\Subscriber;
use FOS\RestBundle\Controller\Annotations as Rest;
use Viettut\Model\Core\SubscriberInterface;

/**
 * @RouteResource("Subscribe")
 */
class SubscribeController extends FOSRestController
{
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
        $params = $request->request->all();
        if (!array_key_exists('email', $params)) {
            return false;
        }
        $subscriber = $this->get('viettut.repository.subscriber')->getByEmail($params['email']);
        if (!$subscriber instanceof SubscriberInterface) {
            $subscriber = new Subscriber();
            $subscriber->setEmail($params['email']);
            $this->getDoctrine()->getEntityManager()->persist($subscriber);
            $this->getDoctrine()->getEntityManager()->flush();
        }
        return true;
    }
}