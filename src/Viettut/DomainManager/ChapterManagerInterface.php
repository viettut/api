<?php
/**
 * Created by PhpStorm.
 * User: giang
 * Date: 10/21/15
 * Time: 10:07 PM
 */

namespace Viettut\DomainManager;


use Viettut\Model\Core\CourseInterface;
use Viettut\Model\User\Role\LecturerInterface;

interface ChapterManagerInterface extends ManagerInterface
{
    /**
     * @param LecturerInterface $lecturer
     * @param null $limit
     * @param null $offset
     * @return mixed
     */
    public function getChapterByLecturer(LecturerInterface $lecturer, $limit = null, $offset = null);

    /**
     * @param CourseInterface $course
     * @param null $limit
     * @param null $offset
     * @return mixed
     */
    public function getChaptersByCourse(CourseInterface $course, $limit = null, $offset = null);
}