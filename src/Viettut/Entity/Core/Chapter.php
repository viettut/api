<?php
/**
 * Created by PhpStorm.
 * User: giang
 * Date: 10/21/15
 * Time: 9:48 PM
 */

namespace Viettut\Entity\Core;
use Viettut\Model\Core\Chapter as ChapterModel;

class Chapter extends ChapterModel
{
    protected $id;
    protected $header;
    protected $hashTag;
    protected $content;
    protected $position;
    protected $comments;
    protected $active;
    protected $token;
    protected $published;
    protected $author;
    protected $course;
    protected $createdAt;
    protected $updatedAt;
    protected $deletedAt;

    function __construct()
    {
    }
}