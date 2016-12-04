<?php
/**
 * Created by PhpStorm.
 * User: giang
 * Date: 10/21/15
 * Time: 9:48 PM
 */

namespace Viettut\Entity\Core;
use Viettut\Model\Core\TutorialTag as TutorialTagModel;

class TutorialTag extends TutorialTagModel
{
    protected $id;
    protected $tutorial;
    protected $tag;
    protected $createdAt;
    protected $deletedAt;

    function __construct()
    {
    }
}