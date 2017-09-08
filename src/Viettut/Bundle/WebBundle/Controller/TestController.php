<?php


namespace Viettut\Bundle\WebBundle\Controller;
use FOS\RestBundle\Controller\FOSRestController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class TestController extends FOSRestController
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
}