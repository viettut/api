<?php
/**
 * Created by PhpStorm.
 * User: giang
 * Date: 2/25/17
 * Time: 4:12 PM
 */

namespace Viettut\Services;


use Embera\Embera;
use Viettut\Exception\InvalidArgumentException;

class VideoService implements VideoServiceInterface
{
    /**
     * @var Embera
     */
    protected $videoFactory;
    
    /**
     * VideoService constructor.
     *
     * @param $width
     * @param $height
     */
    public function __construct($width, $height)
    {
        $config = array(
            'params' => array(
                'width' => $width,
                'height' => $height
            )
        );

        $this->videoFactory = new Embera($config);
    }

    /**
     * @param $link
     * @return string
     */
    public function getVideoObject($link)
    {
        $object = $this->videoFactory->autoEmbed($link);
        if ($this->videoFactory->hasErrors()) {
            throw new InvalidArgumentException($this->videoFactory->getLastError());
        }

        return $object;
    }
}