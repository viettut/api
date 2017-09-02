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

interface TestRepositoryInterface extends ObjectRepository
{
    /**
     * @param UserEntityInterface $user
     * @param null $limit
     * @param null $offset
     * @return mixed
     */
    public function getTestForUser(UserEntityInterface $user, $limit = null, $offset = null);
}