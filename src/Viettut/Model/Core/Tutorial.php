<?php
/**
 * Created by PhpStorm.
 * User: giang
 * Date: 10/21/15
 * Time: 9:39 PM
 */

namespace Viettut\Model\Core;


use Doctrine\Common\Collections\ArrayCollection;
use Viettut\Model\User\UserEntityInterface;

class Tutorial implements TutorialInterface
{
    /**
     * @var integer
     */
    protected $id;

    /**
     * @var string
     */
    protected $title;

    /**
     * @var string
     */
    protected $hashTag;

    /**
     * @var string
     */
    protected $content;

    /**
     * @var boolean
     */
    protected $active;

    /**
     * @var UserEntityInterface
     */
    protected $author;

    /**
     * @var TutorialTagInterface[]
     */
    protected $tutorialTags;

    /**
     * @var CommentInterface[]
     */
    protected $comments;

    /**
     * @var integer
     */
    protected $likes;

    /**
     * @var integer
     */
    protected $view;

    /**
     * @var \DateTime
     */
    protected $createdAt;

    /**
     * @var \DateTime
     */
    protected $updatedAt;

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
     * @return $this
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    /**
     * Set hashtag
     *
     * @param string $hashTag
     * @return self
     */
    public function setHashTag($hashTag)
    {
        $this->hashTag = $hashTag;
        return $this;
    }

    /**
     * Get hashtag
     *
     * @return string
     */
    public function getHashTag()
    {
        return $this->hashTag;
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
     * @return \DateTime
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    /**
     * @return ArrayCollection
     */
    public function getComments()
    {
        if ($this->comments === null) {
            $this->comments = new ArrayCollection();
        }
        return $this->comments;
    }

    /**
     * @param $comments
     * @return self
     */
    public function setComments($comments)
    {
        $this->comments = $comments;
        return $this;
    }

    /**
     * @return int
     */
    public function getView()
    {
        return $this->view;
    }

    /**
     * @param int $view
     * @return self
     */
    public function setView($view)
    {
        $this->view = $view;
        return $this;
    }

    /**
     * @return int
     */
    public function getLikes()
    {
        return $this->likes;
    }

    /**
     * @param int $likes
     * @return self
     */
    public function setLikes($likes)
    {
        $this->likes = $likes;
        return $this;
    }

    /**
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param string $title
     * @return self
     */
    public function setTitle($title)
    {
        $this->title = $title;
        return $this;
    }

    /**
     * @return ArrayCollection
     */
    public function getTutorialTags()
    {
        if ($this->tutorialTags === null) {
            $this->tutorialTags = new ArrayCollection();
        }

        return $this->tutorialTags;
    }

    /**
     * @param $tutorialTags
     * @return self
     */
    public function setTutorialTags($tutorialTags)
    {
        $this->tutorialTags = $tutorialTags;
        return $this;
    }
}