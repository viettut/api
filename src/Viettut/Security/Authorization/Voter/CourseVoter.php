<?php
/**
 * Created by PhpStorm.
 * User: giang
 * Date: 11/1/15
 * Time: 10:36 AM
 */

namespace Viettut\Security\Authorization\Voter;


use Viettut\Model\Core\CourseInterface;
use Viettut\Model\User\UserEntityInterface;

class CourseVoter extends EntityVoterAbstract
{
    /**
     * Checks to see if a publisher has permission to perform an action
     *
     * @param CourseInterface $entity
     * @param UserEntityInterface $user
     * @param $action
     * @return bool
     */
    protected function isPublisherActionAllowed($entity, UserEntityInterface $user, $action)
    {
        return $user->getId() === $entity->getAuthor()->getId();
    }


    public function supportsClass($class)
    {
        $supportedClass = CourseInterface::class;
        return $supportedClass === $class || is_subclass_of($class, $supportedClass);
    }
}