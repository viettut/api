<?php
/**
 * Created by PhpStorm.
 * User: giang
 * Date: 8/31/17
 * Time: 10:27 PM
 */

namespace Viettut\Model\Core;


use Viettut\Model\User\UserEntityInterface;

class Challenge implements ChallengeInterface
{
    /**
     * @var int
     */
    protected $id;

    /**
     * @var string
     */
    protected $name;

    /**
     * @var UserEntityInterface
     */
    protected $author;

    /**
     * time by seconds
     * @var int
     */
    protected $timeLimit;

    /**
     * @var int
     */
    protected $total;

    /**
     * @var TestCollectionInterface[]
     */
    protected $testCollection;

    /**
     * TestCollection constructor.
     */
    public function __construct()
    {
        $this->timeLimit = -1;
        $this->total = 0;
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

    /**
     * @return TestCollectionInterface[]
     */
    public function getTestCollection()
    {
        return $this->testCollection;
    }

    /**
     * @param TestCollectionInterface[] $testCollection
     */
    public function setTestCollection($testCollection)
    {
        $this->testCollection = $testCollection;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }
}