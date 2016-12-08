<?php


namespace Viettut\Model\Core;


use Viettut\Model\ModelInterface;
use Viettut\Model\User\UserEntityInterface;

interface UserChapterInterface extends ModelInterface
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
    public function setCourse(CourseInterface $course);

    /**
     * @return UserEntityInterface
     */
    public function getUser();

    /**
     * @param UserEntityInterface $user
     * @return self
     */
    public function setUser($user);

    /**
     * @return ChapterInterface
     */
    public function getLatestChapter();

    /**
     * @param ChapterInterface $latestChapter
     * @return self
     */
    public function setLatestChapter($latestChapter);

    /**
     * @return \DateTime
     */
    public function getCreatedAt();

    /**
     * @return \DateTime
     */
    public function getUpdatedAt();
}