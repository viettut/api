<?php
/**
 * Created by PhpStorm.
 * User: giang
 * Date: 10/21/15
 * Time: 9:48 PM
 */

namespace Viettut\Entity\Core;
use Viettut\Model\Core\Tutorial as TutorialModel;

class Tutorial extends TutorialModel
{
    protected $id;
    protected $title;
    protected $hashTag;
    protected $content;
    protected $active;
    protected $author;
    protected $comments;
    protected $tutorialTags;
    protected $likes;
    protected $view;
    protected $published;
    protected $video;
    protected $hasVideo;
    protected $createdAt;
    protected $updatedAt;
    protected $deletedAt;

    function __construct()
    {
    }
}