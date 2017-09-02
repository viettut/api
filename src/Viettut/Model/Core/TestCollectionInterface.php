<?php


namespace Viettut\Model\Core;


use Viettut\Model\ModelInterface;

interface TestCollectionInterface extends ModelInterface
{
    /**
     * @param int $id
     * @return self
     */
    public function setId($id);

    /**
     * @return TestInterface
     */
    public function getTest();

    /**
     * @param TestInterface $test
     * @return self
     */
    public function setTest($test);

    /**
     * @return ChallengeInterface
     */
    public function getChallenge();

    /**
     * @param ChallengeInterface $challenge
     * @return self
     */
    public function setChallenge($challenge);

    /**
     * @return int
     */
    public function getEarnedPoint();

    /**
     * @param int $earnedPoint
     */
    public function setEarnedPoint($earnedPoint);

    /**
     * @return int
     */
    public function getTimeLimit();

    /**
     * @param int $timeLimit
     */
    public function setTimeLimit($timeLimit);

    /**
     * @return int
     */
    public function getPosition();

    /**
     * @param int $position
     */
    public function setPosition($position);
}