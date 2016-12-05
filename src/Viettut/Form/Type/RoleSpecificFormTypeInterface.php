<?php

namespace Viettut\Form\Type;

use Symfony\Component\Form\FormTypeInterface;
use Viettut\Model\User\UserEntityInterface;

interface RoleSpecificFormTypeInterface extends FormTypeInterface
{
    public function setUserRole(UserEntityInterface $userRole);
}