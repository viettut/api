<?php
/**
 * Created by PhpStorm.
 * User: giang
 * Date: 10/21/15
 * Time: 9:24 PM
 */

namespace Viettut\Model\Core;


use Viettut\Model\User\UserEntityInterface;

class UserChapter implements UserChapterInterface
{
    /**
     * @var integer
     */
    protected $id;

    /**
     * @var UserEntityInterface
     */
    protected $user;

    /**
     * @var CourseInterface
     */
    protected $course;

    /**
     * @var ChapterInterface
     */
    protected $latestChapter;

    /**
     * @var \DateTime
     */
    protected $createdAt;

    /**
     * @var \DateTime
     */
    protected $updatedAt;

    function __construct()
    {
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
    public function setCourse(CourseInterface $course)
    {
        $this->course = $course;
        return $this;
    }

    /**
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return UserEntityInterface
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @param UserEntityInterface $user
     * @return self
     */
    public function setUser($user)
    {
        $this->user = $user;
        return $this;
    }

    /**
     * @return ChapterInterface
     */
    public function getLatestChapter()
    {
        return $this->latestChapter;
    }

    /**
     * @param ChapterInterface $latestChapter
     * @return self
     */
    public function setLatestChapter($latestChapter)
    {
        $this->latestChapter = $latestChapter;
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
     * @return \DateTime
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }
}