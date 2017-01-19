<?php
/**
 * Created by PhpStorm.
 * User: giang
 * Date: 10/21/15
 * Time: 9:48 PM
 */

namespace Viettut\Entity\Core;
use Viettut\Model\Core\Course as CourseModel;

class Course extends CourseModel
{
    protected $id;
    protected $title;
    protected $introduce;
    protected $author;
    protected $chapters;
    protected $courseTags;
    protected $imagePath;
    protected $active;
    protected $token;
    protected $hashTag;
    protected $comments;
    protected $view;
    protected $published;
    protected $enroll;
    protected $createdAt;
    protected $updatedAt;
    protected $deletedAt;

    function __construct()
    {
    }
}