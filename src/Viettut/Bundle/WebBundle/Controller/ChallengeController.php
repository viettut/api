<?php


namespace Viettut\Bundle\WebBundle\Controller;
use FOS\RestBundle\Controller\FOSRestController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Viettut\Model\Core\ChallengeInterface;
use Viettut\Model\Core\CourseInterface;

class ChallengeController extends FOSRestController
{
    /**
     * @Security("has_role('ROLE_USER')")
     *
     * @Route("/challenges/create", name="create_challenge")
     *
     * @Template()
     */
    public function createAction()
    {
        return $this->render('ViettutWebBundle:Challenge:create.html.twig');
    }

    /**
     * @Security("has_role('ROLE_USER')")
     *
     * @Route("/challenges/{token}/edit", name="challenge_edit")
     *
     * @param string $token
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @Template()
     */
    public function editAction($token)
    {
        $challenge = $this->get('viettut.repository.challenge')->getChallengeByToken($token);
        if(!$challenge instanceof ChallengeInterface) {
            throw new NotFoundHttpException('challenge not found or you do not have enough permission');
        }

        return $this->render('ViettutWebBundle:Challenge:edit.html.twig', array ('challenge' => $challenge));
    }

    /**
     * @Route("/challenges/all", name="challenge_index")
     *
     * @param $request
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @Template()
     */
    public function indexAction(Request $request)
    {
        $pageSize = $this->getParameter('page_size');

        $pagination = $this->get('knp_paginator')->paginate(
            $this->get('viettut.repository.challenge')->getAllChallengeQuery(true),
            $request->query->getInt('page', 1)/*page number*/,
            $pageSize
        );

        return $this->render('ViettutWebBundle:Challenge:index.html.twig', array ("pagination" => $pagination));
    }


    /**
     * @Security("has_role('ROLE_USER')")
     *
     * @Route("/challenges/{token}/add-test", name="add_test")
     *
     * @param string $token
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @Template()
     */
    public function addTestAction($token)
    {
        $challenge = $this->get('viettut.repository.challenge')->getChallengeByToken($token);
        if(!$challenge instanceof ChallengeInterface) {
            throw new NotFoundHttpException('challenge not found or you do not have enough permission');
        }

        return $this->render('ViettutWebBundle:Challenge:addTest.html.twig', array ('challenge' => $challenge));
    }

    /**
     * @Security("has_role('ROLE_USER')")
     *
     * @Route("/mychallenges/", name="my_challenges")
     *
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @Template()
     */
    public function myChallengesAction()
    {
        $user = $this->getUser();
        $challenges = $this->get('viettut.repository.challenge')->getChallengeByUser($user, $published = null);
        return $this->render('ViettutWebBundle:Challenge:myChallenge.html.twig', array('challenges' => $challenges));
    }
}