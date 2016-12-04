<?php
/**
 * Created by PhpStorm.
 * User: giang
 * Date: 10/21/15
 * Time: 9:07 PM
 */

namespace Viettut\Model\Core;


use Viettut\Model\ModelInterface;

interface CourseTagInterface extends ModelInterface
{
    /**
     * @param $id
     * @return self
     */
    public function setId($id);

    /**
     * @return CourseInterface
     */
    public function getCourse();

    /**
     * @param CourseInterface $course
     * @return self
     */
    public function setCourse($course);

    /**
     * @return TagInterface
     */
    public function getTag();

    /**
     * @param TagInterface $tag
     * @return self
     */
    public function setTag($tag);

    /**
     * @return \DateTime
     */
    public function getCreatedAt();

    /**
     * Get deletedAt
     *
     * @return \DateTime
     */
    public function getDeletedAt();
}