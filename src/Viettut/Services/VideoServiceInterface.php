<?php
/**
 * Created by PhpStorm.
 * User: giang
 * Date: 2/25/17
 * Time: 4:20 PM
 */

namespace Viettut\Services;


interface VideoServiceInterface
{
    /**
     * @param $link
     * @return string
     */
    public function getVideoObject($link);
}