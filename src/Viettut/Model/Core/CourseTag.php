<?php
/**
 * Created by PhpStorm.
 * User: giang
 * Date: 10/21/15
 * Time: 9:10 PM
 */

namespace Viettut\Model\Core;

class CourseTag implements CourseTagInterface
{
    /**
     * @var integer
     */
    protected $id;

    /**
     * @var CourseInterface
     */
    protected $course;

    /**
     * @var TagInterface
     */
    protected $tag;

    /**
     * @var \DateTime
     */
    protected $createdAt;

    /**
     * @var \DateTime
     */
    protected $deletedAt;


    function __construct()
    {
    }


    /**
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param $id
     * @return self
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return CourseInterface
     */
    public function getCourse()
    {
        return $this->course;
    }

    /**
     * @param CourseInterface $course
     * @return self
     */
    public function setCourse($course)
    {
        $this->course = $course;
        return $this;
    }

    /**
     * @return TagInterface
     */
    public function getTag()
    {
        return $this->tag;
    }

    /**
     * @param TagInterface $tag
     * @return self
     */
    public function setTag($tag)
    {
        $this->tag = $tag;
        return $this;
    }


    /**
     * @return \DateTime
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * Get deletedAt
     *
     * @return \DateTime
     */
    public function getDeletedAt()
    {
        return $this->deletedAt;
    }
}
