<?php
/**
 * Created by PhpStorm.
 * User: giang
 * Date: 10/31/15
 * Time: 10:20 PM
 */

namespace Viettut\Bundle\WebBundle\Controller;


use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Viettut\Exception\InvalidArgumentException;
use Viettut\Model\Core\CourseInterface;
use Viettut\Model\Core\TutorialInterface;
use Viettut\Model\User\Role\LecturerInterface;
use Viettut\Model\User\UserEntityInterface;
use FOS\RestBundle\Controller\Annotations as Rest;

class TagController extends Controller
{
    /**
     * @Rest\Get("/tag/{tag}", name="tag_index")
     * @param $tag
     * @Template()
     */
    public function indexAction($tag)
    {
        $courses = $this->get('viettut.repository.course')->getByTagName($tag);
        $tutorials = $this->get('viettut.repository.tutorial')->getByTagName($tag);
        return $this->render('ViettutWebBundle:Tag:index.html.twig', array (
            'courses' => $courses,
            'tutorials' => $tutorials,
            'tag' => $tag
        ));
    }
}