<?php
/**
 * Created by PhpStorm.
 * User: giang
 * Date: 10/21/15
 * Time: 10:48 PM
 */

namespace Viettut\Handler\Handlers\Core\Lecturer;


use Viettut\Handler\Handlers\Core\CourseHandlerAbstract;
use Viettut\Model\Core\CourseInterface;
use Viettut\Model\ModelInterface;
use Viettut\Model\User\Role\LecturerInterface;
use Viettut\Model\User\Role\UserRoleInterface;

class CourseHandler extends CourseHandlerAbstract{

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
        return $this->getDomainManager()->getCourseByLecturer($lecturer, $limit, $offset);
    }

    protected function processForm(ModelInterface $entity, array $parameters, $method = 'PUT')
    {
        /**
         * @var CourseInterface $entity
         */
        if (null === $entity->getAuthor()) {
            $entity->setAuthor($this->getUserRole());
        }

        return parent::processForm($entity, $parameters, $method);
    }
}