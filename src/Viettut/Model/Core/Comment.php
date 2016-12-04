<?php
/**
 * Created by PhpStorm.
 * User: giang
 * Date: 10/21/15
 * Time: 9:24 PM
 */

namespace Viettut\Model\Core;


use Doctrine\Common\Collections\ArrayCollection;
use Viettut\Model\User\UserEntityInterface;

class Comment implements CommentInterface
{
    /**
     * @var integer
     */
    protected $id;

    /**
     * @var string
     */
    protected $content;

    /**
     * @var string
     */
    protected $active;

    /**
     * @var UserEntityInterface
     */
    protected $author;

    /**
     * @var CourseInterface
     */
    protected $course;

    /**
     * @var TutorialInterface
     */
    protected $tutorial;

    /**
     * @var ChapterInterface
     */
    protected $chapter;

    /**
     * @var ArrayCollection
     */
    protected $replies;

    /**
     * @var CommentInterface
     */
    protected $replyFor;

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
     * @param $id
     * @return $this
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    /**
     * Set content
     *
     * @param string $content
     * @return self
     */
    public function setContent($content)
    {
        $this->content = $content;
        return $this;
    }

    /**
     * Get content
     *
     * @return string
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * Set active
     *
     * @param boolean $active
     * @return self
     */
    public function setActive($active)
    {
        $this->active = $active;
        return $this;
    }

    /**
     * Get active
     *
     * @return boolean
     */
    public function getActive()
    {
        return $this->active;
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

    /**
     * @return UserEntityInterface
     */
    public function getAuthor()
    {
        return $this->author;
    }

    /**
     * @param UserEntityInterface $author
     * @return self
     */
    public function setAuthor(UserEntityInterface $author)
    {
        $this->author = $author;
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
     * @return integer
     */
    public function getId()
    {
        return $this->id;
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
     * @return ChapterInterface
     */
    public function getChapter()
    {
        return $this->chapter;
    }

    /**
     * @param ChapterInterface $chapter
     * @return self
     */
    public function setChapter($chapter)
    {
        $this->chapter = $chapter;
        return $this;
    }

    /**
     * @return TutorialInterface
     */
    public function getTutorial()
    {
        return $this->tutorial;
    }

    /**
     * @param TutorialInterface $tutorial
     * @return self
     */
    public function setTutorial($tutorial)
    {
        $this->tutorial = $tutorial;
        return $this;
    }

    /**
     * @return ArrayCollection
     */
    public function getReplies()
    {
        return $this->replies;
    }

    /**
     * @param ArrayCollection $replies
     */
    public function setReplies($replies)
    {
        $this->replies = $replies;
    }

    /**
     * @return CommentInterface
     */
    public function getReplyFor()
    {
        return $this->replyFor;
    }

    /**
     * @param CommentInterface $replyFor
     */
    public function setReplyFor($replyFor)
    {
        $this->replyFor = $replyFor;
    }

    /**
     * @param CommentInterface $reply
     * @return self
     */
    public function addReply(CommentInterface $reply)
    {
        if ($this->replies === null) {
            $this->replies = new ArrayCollection();
        }

        $this->replies->add($reply);

        return $this;
    }


    function __toString()
    {
        return 'comment_' . $this->id;
    }
}