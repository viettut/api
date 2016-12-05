<?php

namespace Viettut\Handler;

use Viettut\Exception\LogicException;
use Viettut\Model\User\UserEntityInterface;

interface RoleHandlerInterface extends HandlerInterface
{
    /**
     * @param UserEntityInterface $role
     * @return bool
     */
    public function supportsRole(UserEntityInterface $role);

    public function setUserRole(UserEntityInterface $userRole);

    /**
     * @return UserEntityInterface
     * @throws LogicException
     */
    public function getUserRole();
}