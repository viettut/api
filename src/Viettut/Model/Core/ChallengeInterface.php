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
}