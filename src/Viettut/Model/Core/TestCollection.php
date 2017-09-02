<?php


namespace Viettut\Model\Core;


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
     * @var ChallengeInterface
     */
    protected $challenge;

    /**
     * @var int
     */
    protected $earnedPoint;

    /**
     * @var int
     */
    protected $timeLimit;

    /**
     * @var int
     */
    protected $position;

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     * @return self
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
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
     * @return self
     */
    public function setTest($test)
    {
        $this->test = $test;
        return $this;
    }

    /**
     * @return ChallengeInterface
     */
    public function getChallenge()
    {
        return $this->challenge;
    }

    /**
     * @param ChallengeInterface $challenge
     * @return self
     */
    public function setChallenge($challenge)
    {
        $this->challenge = $challenge;
        return $this;
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
}