<?php
/**
 * Created by PhpStorm.
 * User: giang
 * Date: 10/21/15
 * Time: 10:07 PM
 */

namespace Viettut\DomainManager;


use Viettut\Model\User\Role\LecturerInterface;

interface CourseManagerInterface extends ManagerInterface
{
    /**
     * @param LecturerInterface $lecturer
     * @param null $limit
     * @param null $offset
     * @return mixed
     */
    public function getCourseByLecturer(LecturerInterface $lecturer, $limit = null, $offset = null);
}