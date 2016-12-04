<?php
/**
 * Created by PhpStorm.
 * User: giang
 * Date: 9/27/15
 * Time: 4:21 PM
 */

namespace Viettut\Bundle\WebBundle\Twig;


class ParagraphExtension extends \Twig_Extension
{

    public function getName()
    {
        return 'paragraph_extension';
    }

    public function getFilters()
    {
        return array(
            new \Twig_SimpleFilter('first_para', array($this, 'paraFilter')),
        );
    }

    public function paraFilter($string)
    {
        $string = substr($string,0, strpos($string, "\n"));
        return $string. '...';
    }

}