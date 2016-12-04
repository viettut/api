<?php
/**
 * Created by PhpStorm.
 * User: giang
 * Date: 10/21/15
 * Time: 9:48 PM
 */

namespace Viettut\Entity\Core;
use Viettut\Model\Core\Tag as TagModel;

class Tag extends TagModel
{
    protected $id;
    protected $text;
    protected $icon;
    protected $count;
    protected $courseTags;
    protected $tutorialTags;
    protected $createdAt;
    protected $deletedAt;

    function __construct()
    {
    }
}