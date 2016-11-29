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

class HomeController extends Controller
{
    /**
     * @Route("/", name="home_page")
     * @param $request
     * @return Response
     */
    public function indexAction(Request $request)
    {
        $user = $this->getUser();
        $loggedIn = false;

        return $this->render('ViettutWebBundle:Home:index.html.twig', array(
            "popularCourses" => [],
            "popularTutorial" => []
        ));
    }


    /**
     * @Route("/coming-soon", name="coming_soon")
     */
    public function comingSoonAction()
    {
        return $this->render('ViettutWebBundle:Home:comingSoon.html.twig');
    }
}