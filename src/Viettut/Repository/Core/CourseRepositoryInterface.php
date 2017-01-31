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

interface CourseRepositoryInterface extends ObjectRepository
{
    /**
     * @param UserEntityInterface $user
     * @param bool $published
     * @param null $limit
     * @param null $offset
     * @return mixed
     */
    public function getCourseByUser(UserEntityInterface $user, $published = true, $limit = null, $offset = null);

    /**
     * @param $hashTag
     * @return null|CourseInterface
     */
    public function getCourseByHashTag($hashTag);

    /**
     * @param $tagName
     * @param null $limit
     * @param null $offset
     * @return mixed
     */
    public function getByTagName($tagName, $limit = null, $offset = null);

    /**
     * @param $token
     * @return mixed
     */
    public function getCourseByToken($token);

    /**
     * @param int $maxResult
     * @return array
     */
    public function getPopularCourse($maxResult);

    /**
     * @param int $maxResult
     * @return array
     */
    public function getRecentCourse($maxResult);

    /**
     * @param UserEntityInterface $user
     * @param $hash
     * @return CourseInterface | null
     */
    public function getByUserAndHash(UserEntityInterface $user, $hash);

    /**
     * @param $published = null
     * @return mixed
     */
    public function getAllCourseQuery($published = null);

    /**
     * @param $keyword
     * @return mixed
     */
    public function search($keyword);
}