<?php

namespace Viettut\Bundle\UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('ViettutUserBundle:Default:index.html.twig');
    }
}
