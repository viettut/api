<?php
/**
 * Created by PhpStorm.
 * User: giang
 * Date: 24/02/2016
 * Time: 22:02
 */

namespace Viettut\Bundle\WebBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use FOS\RestBundle\Controller\Annotations as Rest;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class SearchController extends Controller
{
    /**
     * @Route("/public/search", name="public_search")
     * @param $request
     * @Template()
     */
    public function searchAction(Request $request)
    {
        $keyword = $request->query->get('q');
        $courses = $this->get('viettut.repository.course')->search($keyword);
        $tutorials = $this->get('viettut.repository.tutorial')->search($keyword);

        return $this->render('ViettutWebBundle:Search:search.html.twig', array(
            'courses' => $courses,
            'tutorials' => $tutorials,
            'keyword' => $keyword,
            'totalMatch' => count($courses) + count($tutorials)
        ));
    }
}