<?php
/**
 * Created by PhpStorm.
 * User: giang
 * Date: 10/21/15
 * Time: 9:48 PM
 */

namespace Viettut\Entity\Core;
use Viettut\Model\Core\Comment as CommentModel;

class Comment extends CommentModel
{
    protected $id;
    protected $content;
    protected $active;
    protected $author;
    protected $course;
    protected $tutorial;
    protected $chapter;
    protected $replies;
    protected $replyFor;
    protected $createdAt;
    protected $deletedAt;

    function __construct()
    {
    }
}