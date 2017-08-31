<?php
/**
 * Created by PhpStorm.
 * User: giang
 * Date: 8/31/17
 * Time: 10:30 PM
 */

namespace Viettut\Entity\Core;
use Viettut\Model\Core\TestCollection as TestCollectionModel;

class TestCollection extends TestCollectionModel
{
    protected $id;
    protected $test;
    protected $position;
    protected $timeLimit;
    protected $earnedPoint;
    protected $total;
    protected $createdAt;
    protected $updatedAt;
}