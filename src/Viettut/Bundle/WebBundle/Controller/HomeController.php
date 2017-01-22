<?php
/**
 * Created by PhpStorm.
 * User: giang
 * Date: 10/31/15
 * Time: 10:42 PM
 */

namespace Viettut\Bundle\WebBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Viettut\Entity\Core\Subscriber;
use Viettut\Model\Core\SubscriberInterface;

class HomeController extends Controller
{
    /**
     * @Route("/", name="home_page")
     * @param $request
     * @return Response
     */
    public function indexAction(Request $request)
    {
        $popularSize = $this->container->getParameter('popular_size');
        $popularCourses = $this->get('viettut.repository.course')->getPopularCourse(intval($popularSize));
        $popularTutorials = $this->get('viettut.repository.tutorial')->getPopularTutorial(intval($popularSize));
        return $this->render('ViettutWebBundle:Home:index.html.twig', array(
            "popularCourses" => $popularCourses,
            "popularTutorial" => $popularTutorials
        ));
    }


    /**
     * @Route("/coming-soon", name="coming_soon")
     */
    public function comingSoonAction()
    {
        return $this->render('ViettutWebBundle:Home:comingSoon.html.twig');
    }


    /**
     * @Route("/public/api/subscribe", name="user_subscribe")
     * @Method("POST")
     * @param Request $request
     */
    public function subscribeAction(Request $request)
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