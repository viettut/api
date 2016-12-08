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
use Viettut\Model\User\UserEntityInterface;

interface ChapterRepositoryInterface extends ObjectRepository
{
    /**
     * @param UserEntityInterface $user
     * @param null $limit
     * @param null $offset
     * @return mixed
     */
    public function getChapterByUser(UserEntityInterface $user, $limit = null, $offset = null);

    /**
     * @param CourseInterface $course
     * @param null $limit
     * @param null $offset
     * @return mixed
     */
    public function getChaptersByCourse(CourseInterface $course, $limit = null, $offset = null);

    /**
     * @param CourseInterface $course
     * @param $hash
     * @return mixed
     */
    public function getChapterByCourseAndHash(CourseInterface $course, $hash);

    /**
     * @param CourseInterface $course
     * @param $position
     * @return mixed
     */
    public function getChapterByCourseAndPosition(CourseInterface $course, $position);

    /**
     * @param $token
     * @return mixed
     */
    public function getByToken($token);
}