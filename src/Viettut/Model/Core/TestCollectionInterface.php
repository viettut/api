<?php
/**
 * Created by PhpStorm.
 * User: giang
 * Date: 8/31/17
 * Time: 10:27 PM
 */

namespace Viettut\Model\Core;


use Viettut\Model\ModelInterface;
use Viettut\Model\User\UserEntityInterface;

interface TestCollectionInterface extends ModelInterface
{
    /**
     * @param int $id
     */
    public function setId($id);

    /**
     * @return TestInterface
     */
    public function getTest();

    /**
     * @param TestInterface $test
     */
    public function setTest($test);

    /**
     * @return int
     */
    public function getPosition();

    /**
     * @param int $position
     */
    public function setPosition($position);

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
    public function getEarnedPoint();

    /**
     * @param int $earnedPoint
     */
    public function setEarnedPoint($earnedPoint);

    /**
     * @return int
     */
    public function getTotal();

    /**
     * @param int $total
     */
    public function setTotal($total);

    /**
     * @return UserEntityInterface
     */
    public function getAuthor();

    /**
     * @param UserEntityInterface $author
     */
    public function setAuthor($author);
}