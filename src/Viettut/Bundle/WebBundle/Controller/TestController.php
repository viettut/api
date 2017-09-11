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
     * @Route("/tests/create", name="create_test")
     *
     * @Template()
     */
    public function createAction()
    {
        $languages = [array('id' => 'php', 'name' => 'php 7.0'), array('id' => 'javascript', 'name' => 'Javascript')];
        return $this->render('ViettutWebBundle:Test:create.html.twig', array('languages' => $languages));
    }

    /**
     * @Security("has_role('ROLE_USER')")
     *
     * @Route("/mytests/", name="my_tests")
     *
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @Template()
     */
    public function myTestsAction()
    {
        $user = $this->getUser();
        $tests = $this->get('viettut.repository.test')->getTestForUser($user);
        return $this->render('ViettutWebBundle:Test:myTests.html.twig', array('tests' => $tests));
    }
}