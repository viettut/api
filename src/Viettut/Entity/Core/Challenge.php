<?php
/**
 * Created by PhpStorm.
 * User: giang
 * Date: 8/31/17
 * Time: 10:30 PM
 */

namespace Viettut\Entity\Core;
use Viettut\Model\Core\Challenge as ChallengeModel;

class Challenge extends ChallengeModel
{
    protected $id;
    protected $name;
    protected $timeLimit;
    protected $total;
    protected $testCollection;
    protected $author;
    protected $createdAt;
    protected $updatedAt;
}