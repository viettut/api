<?php
/**
 * Created by PhpStorm.
 * User: giang
 * Date: 10/21/15
 * Time: 9:01 PM
 */

namespace Viettut\Repository\Core;
use Doctrine\Common\Persistence\ObjectRepository;
use Viettut\Model\Core\CourseInterface;
use Viettut\Model\Core\UserChapterInterface;
use Viettut\Model\User\UserEntityInterface;

interface UserChapterRepositoryInterface extends ObjectRepository
{
    /**
     * @param UserEntityInterface $user
     * @param CourseInterface $course
     * @return null|UserChapterInterface
     */
    public function getUserChapterByUserAndCourse(UserEntityInterface $user, CourseInterface $course);
}