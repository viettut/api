<?php
/**
 * Created by PhpStorm.
 * User: giang
 * Date: 10/21/15
 * Time: 10:07 PM
 */

namespace Viettut\DomainManager;


use Viettut\Model\Core\CourseInterface;
use Viettut\Model\Core\UserChapterInterface;
use Viettut\Model\User\UserEntityInterface;

interface UserChapterManagerInterface extends ManagerInterface
{
    /**
     * @param UserEntityInterface $user
     * @param CourseInterface $course
     * @return null|UserChapterInterface
     */
    public function getUserChapterByUserAndCourse(UserEntityInterface $user, CourseInterface $course);
}