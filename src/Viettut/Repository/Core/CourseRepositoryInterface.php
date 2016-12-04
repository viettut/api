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
use Viettut\Model\User\Role\LecturerInterface;

interface CourseRepositoryInterface extends ObjectRepository
{
    /**
     * @param LecturerInterface $lecturer
     * @param null $limit
     * @param null $offset
     * @return mixed
     */
    public function getCourseByLecturer(LecturerInterface $lecturer, $limit = null, $offset = null);

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
     * @param LecturerInterface $lecturer
     * @param $hash
     * @return CourseInterface | null
     */
    public function getByLecturerAndHash(LecturerInterface $lecturer, $hash);

    /**
     * @return mixed
     */
    public function getAllCourseQuery();

    /**
     * @param $keyword
     * @return mixed
     */
    public function search($keyword);
}