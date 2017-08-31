<?php
/**
 * Created by PhpStorm.
 * User: giang
 * Date: 8/31/17
 * Time: 10:27 PM
 */

namespace Viettut\Model\Core;


use Viettut\Model\User\UserEntityInterface;

class TestCollection implements TestCollectionInterface
{
    /**
     * @var int
     */
    protected $id;

    /**
     * @var TestInterface
     */
    protected $test;

    /**
     * @var UserEntityInterface
     */
    protected $author;

    /**
     * @var int
     */
    protected $position;

    /**
     * time by seconds
     * @var int
     */
    protected $timeLimit;

    /**
     * @var int
     */
    protected $earnedPoint;

    /**
     * @var int
     */
    protected $total;

    /**
     * TestCollection constructor.
     */
    public function __construct()
    {
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return TestInterface
     */
    public function getTest()
    {
        return $this->test;
    }

    /**
     * @param TestInterface $test
     */
    public function setTest($test)
    {
        $this->test = $test;
    }

    /**
     * @return int
     */
    public function getPosition()
    {
        return $this->position;
    }

    /**
     * @param int $position
     */
    public function setPosition($position)
    {
        $this->position = $position;
    }

    /**
     * @return int
     */
    public function getTimeLimit()
    {
        return $this->timeLimit;
    }

    /**
     * @param int $timeLimit
     */
    public function setTimeLimit($timeLimit)
    {
        $this->timeLimit = $timeLimit;
    }

    /**
     * @return int
     */
    public function getEarnedPoint()
    {
        return $this->earnedPoint;
    }

    /**
     * @param int $earnedPoint
     */
    public function setEarnedPoint($earnedPoint)
    {
        $this->earnedPoint = $earnedPoint;
    }

    /**
     * @return int
     */
    public function getTotal()
    {
        return $this->total;
    }

    /**
     * @param int $total
     */
    public function setTotal($total)
    {
        $this->total = $total;
    }

    /**
     * @return UserEntityInterface
     */
    public function getAuthor()
    {
        return $this->author;
    }

    /**
     * @param UserEntityInterface $author
     */
    public function setAuthor($author)
    {
        $this->author = $author;
    }
}