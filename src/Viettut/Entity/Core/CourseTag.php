<?php
/**
 * Created by PhpStorm.
 * User: giang
 * Date: 10/21/15
 * Time: 9:48 PM
 */

namespace Viettut\Entity\Core;
use Viettut\Model\Core\CourseTag as CourseTagModel;

class CourseTag extends CourseTagModel
{
    protected $id;
    protected $course;
    protected $tag;
    protected $createdAt;
    protected $deletedAt;

    function __construct()
    {
    }
}