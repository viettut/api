<?php

namespace Viettut\Form\Type;

use Symfony\Component\Form\FormTypeInterface;
use Viettut\Model\User\Role\UserRoleInterface;

interface RoleSpecificFormTypeInterface extends FormTypeInterface
{
    public function setUserRole(UserRoleInterface $userRole);
}