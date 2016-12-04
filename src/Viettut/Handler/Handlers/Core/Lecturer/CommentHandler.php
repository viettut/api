<?php
/**
 * Created by PhpStorm.
 * User: giang
 * Date: 10/21/15
 * Time: 10:48 PM
 */

namespace Viettut\Handler\Handlers\Core\Lecturer;


use Viettut\Handler\Handlers\Core\CommentHandlerAbstract;
use Viettut\Model\Core\CommentInterface;
use Viettut\Model\ModelInterface;
use Viettut\Model\User\Role\BrokerInterface;
use Viettut\Model\User\Role\LecturerInterface;
use Viettut\Model\User\Role\UserRoleInterface;

class CommentHandler extends CommentHandlerAbstract{

    /**
     * @param UserRoleInterface $role
     * @return bool
     */
    public function supportsRole(UserRoleInterface $role)
    {
        return $role instanceof LecturerInterface;
    }

    protected function processForm(ModelInterface $entity, array $parameters, $method = 'PUT')
    {
        /**
         * @var CommentInterface $entity
         */
        if (null === $entity->getAuthor()) {
            $entity->setAuthor($this->getUserRole());
        }

        return parent::processForm($entity, $parameters, $method);
    }

}