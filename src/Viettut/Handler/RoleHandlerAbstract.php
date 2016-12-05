<?php

namespace Viettut\Handler;

use Symfony\Component\Form\FormFactoryInterface;
use Viettut\Exception\InvalidUserRoleException;
use Viettut\Exception\LogicException;
use Viettut\Form\Type\RoleSpecificFormTypeInterface;
use Viettut\Model\User\UserEntityInterface;

/**
 * A role handler is used to have a different handler for different user roles.
 *
 * i.e you may wish an Admin to be able to edit all entities
 * however a Publisher can only edit their entities
 */
abstract class RoleHandlerAbstract extends HandlerAbstract implements RoleHandlerInterface
{
    /**
     * @var RoleSpecificFormTypeInterface
     */
    protected $formType;

    /**
     * @var UserEntityInterface|null
     */
    protected $userRole;

    public function __construct(FormFactoryInterface $formFactory, RoleSpecificFormTypeInterface $formType, $domainManager, UserEntityInterface $userRole = null)
    {
        parent::__construct($formFactory, $formType, $domainManager);

        if ($userRole) {
            $this->setUserRole($userRole);
        }
    }

    public function setUserRole(UserEntityInterface $userRole)
    {
        if (!$this->supportsRole($userRole)) {
            throw new InvalidUserRoleException();
        }

        $this->userRole = $userRole;
    }

    public function getUserRole()
    {
        if (!$this->userRole instanceof UserEntityInterface) {
            throw new LogicException('userRole is not set');
        }

        return $this->userRole;
    }

    /**
     * @inheritdoc
     */
    protected function getFormType()
    {
        if ($this->formType instanceof RoleSpecificFormTypeInterface) {
            $this->formType->setUserRole($this->getUserRole());
        }

        return $this->formType;
    }
}