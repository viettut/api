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

interface ChallengeInterface extends ModelInterface
{
    /**
     * @param int $id
     */
    public function setId($id);

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

    /**
     * @return TestCollectionInterface[]
     */
    public function getTestCollection();

    /**
     * @param TestCollectionInterface[] $testCollection
     */
    public function setTestCollection($testCollection);

    /**
     * @return string
     */
    public function getName();

    /**
     * @param string $name
     */
    public function setName($name);

    /**
     * @return boolean
     */
    public function isPublished();

    /**
     * @param boolean $published
     * @return self
     */
    public function setPublished($published);

    /**
     * @return string
     */
    public function getToken();

    /**
     * @param string $token
     * @return self
     */
    public function setToken($token);

    /**
     * @return string
     */
    public function getHashTag();

    /**
     * @param string $hashTag
     * @return self
     */
    public function setHashTag($hashTag);
}