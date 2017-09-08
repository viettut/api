<?php
/**
 * Created by PhpStorm.
 * User: giang
 * Date: 10/21/15
 * Time: 9:01 PM
 */

namespace Viettut\Repository\Core;
use Doctrine\Common\Persistence\ObjectRepository;
use Viettut\Model\User\UserEntityInterface;

interface ChallengeRepositoryInterface extends ObjectRepository
{
    /**
     * @param UserEntityInterface $user
     * @param null $published
     * @param null $limit
     * @param null $offset
     * @return mixed
     */
    public function getChallengeByUser(UserEntityInterface $user, $published = null, $limit = null, $offset = null);

    /**
     * @param null $published
     * @return array
     */
    public function getAllChallengeQuery($published = null);

    /**
     * @param $token
     * @return mixed
     */
    public function getChallengeByToken($token);
}