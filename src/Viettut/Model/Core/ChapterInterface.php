<?php
/**
 * Created by PhpStorm.
 * User: giang
 * Date: 10/21/15
 * Time: 9:07 PM
 */

namespace Viettut\Model\Core;


use Doctrine\Common\Collections\ArrayCollection;
use Viettut\Model\User\UserEntityInterface;
use Viettut\Model\ModelInterface;

interface ChapterInterface extends ModelInterface
{
    /**
     * @param $id
     * @return self
     */
    public function setId($id);

    /**
     * Set header
     *
     * @param string $header
     * @return self
     */
    public function setHeader($header);

    /**
     * Get header
     *
     * @return string
     */
    public function getHeader();

    /**
     * Set hashTag
     *
     * @param string $hashTag
     * @return self
     */
    public function setHashTag($hashTag);

    /**
     * Get hashTag
     *
     * @return string
     */
    public function getHashTag();

    /**
     * @return boolean
     */
    public function isPublished();

    /**
     * @param boolean $published
     * @return self
     */
    public function setPublished($published);
    /**
     * Set content
     *
     * @param string $content
     * @return self
     */
    public function setContent($content);

    /**
     * Get content
     *
     * @return string
     */
    public function getContent();

    /**
     * Set position
     *
     * @param integer $position
     * @return self
     */
    public function setPosition($position);

    /**
     * Get position
     *
     * @return integer
     */
    public function getPosition();

    /**
     * Set active
     *
     * @param boolean $active
     * @return self
     */
    public function setActive($active);

    /**
     * Get active
     *
     * @return boolean
     */
    public function getActive();

    /**
     * @return mixed
     */
    public function getToken();

    /**
     * @param mixed $token
     * @return self
     */
    public function setToken($token);

    /**
     * Get deletedAt
     *
     * @return \DateTime
     */
    public function getDeletedAt();

    /**
     * @return UserEntityInterface
     */
    public function getAuthor();

    /**
     * @param UserEntityInterface $author
     * @return self
     */
    public function setAuthor(UserEntityInterface $author);

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
     * @return ArrayCollection
     */
    public function getComments();

    /**
     * @param $comments
     * @return self
     */
    public function setComments($comments);
}