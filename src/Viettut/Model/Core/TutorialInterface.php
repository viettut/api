<?php
/**
 * Created by PhpStorm.
 * User: giang
 * Date: 10/21/15
 * Time: 9:07 PM
 */

namespace Viettut\Model\Core;

use Doctrine\Common\Collections\ArrayCollection;
use Viettut\Model\ModelInterface;
use Viettut\Model\User\UserEntityInterface;

interface TutorialInterface extends ModelInterface
{
    /**
     * @param $id
     * @return $this
     */
    public function setId($id);

    /**
     * Set hashtag
     *
     * @param string $hashTag
     * @return self
     */
    public function setHashTag($hashTag);

    /**
     * Get hashtag
     *
     * @return string
     */
    public function getHashTag();

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
     * @return boolean
     */
    public function isPublished();

    /**
     * @param boolean $published
     * @return self
     */
    public function setPublished($published);

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
     * @return \DateTime
     */
    public function getCreatedAt();

    /**
     * @return \DateTime
     */
    public function getUpdatedAt();

    /**
     * @return ArrayCollection
     */
    public function getComments();

    /**
     * @param $comments
     * @return self
     */
    public function setComments($comments);

    /**
     * @return int
     */
    public function getView();

    /**
     * @param int $view
     * @return self
     */
    public function setView($view);

    /**
     * @return int
     */
    public function getLikes();

    /**
     * @param int $likes
     * @return self
     */
    public function setLikes($likes);

    /**
     * @return string
     */
    public function getTitle();

    /**
     * @param string $title
     * @return self
     */
    public function setTitle($title);

    /**
     * @return ArrayCollection
     */
    public function getTutorialTags();

    /**
     * @param $tutorialTags
     * @return self
     */
    public function setTutorialTags($tutorialTags);
}