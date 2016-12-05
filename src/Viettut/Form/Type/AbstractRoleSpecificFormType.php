<?php

namespace Viettut\Form\Type;

use Symfony\Component\Form\AbstractType;
use Viettut\Model\User\Role\UserRoleInterface;
use Viettut\Model\User\UserEntityInterface;

abstract class AbstractRoleSpecificFormType extends AbstractType implements RoleSpecificFormTypeInterface
{
    /**
     * @var UserEntityInterface
     */
    protected $userRole;

    public function setUserRole(UserEntityInterface $userRole)
    {
        $this->userRole = $userRole;
    }
}