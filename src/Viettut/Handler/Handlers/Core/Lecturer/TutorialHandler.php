<?php
/**
 * Created by PhpStorm.
 * User: giang
 * Date: 10/21/15
 * Time: 10:48 PM
 */

namespace Viettut\Handler\Handlers\Core\Lecturer;


use Viettut\Handler\Handlers\Core\TutorialHandlerAbstract;
use Viettut\Model\Core\TutorialInterface;
use Viettut\Model\ModelInterface;
use Viettut\Model\User\Role\LecturerInterface;
use Viettut\Model\User\Role\UserRoleInterface;

class TutorialHandler extends TutorialHandlerAbstract{

    /**
     * @param UserRoleInterface $role
     * @return bool
     */
    public function supportsRole(UserRoleInterface $role)
    {
        return $role instanceof LecturerInterface;
    }

    /**
     * @inheritdoc
     */
    public function all($limit = null, $offset = null)
    {
        /** @var LecturerInterface $lecturer */
        $lecturer = $this->getUserRole();
        return $this->getDomainManager()->getTutorialByLecturer($lecturer, $limit, $offset);
    }

    protected function processForm(ModelInterface $entity, array $parameters, $method = 'PUT')
    {
        /**
         * @var TutorialInterface $entity
         */
        if (null === $entity->getAuthor()) {
            $entity->setAuthor($this->getUserRole());
        }

        return parent::processForm($entity, $parameters, $method);
    }
}