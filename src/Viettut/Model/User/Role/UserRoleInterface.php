<?php

namespace Viettut\Model\User\Role;

use Viettut\Model\User\UserEntityInterface;

interface UserRoleInterface
{
    /**
     * @return UserEntityInterface
     */
    public function getUser();

    /**
     * @return int|null
     */
    public function getId();
}