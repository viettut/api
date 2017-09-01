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
}