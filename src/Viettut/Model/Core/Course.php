<?php
/**
 * Created by PhpStorm.
 * User: giang
 * Date: 10/21/15
 * Time: 9:10 PM
 */

namespace Viettut\Model\Core;
use Doctrine\Common\Collections\ArrayCollection;
use Viettut\Model\User\UserEntityInterface;

class Course implements CourseInterface
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
    protected $introduce;

    /**
     * @var UserEntityInterface
     */
    protected $author;

    /**
     * @var bool
     */
    protected $published = false;

    /**
     * @var string
     */
    protected $videoEmbedded;

    /**
     * @var ChapterInterface[]
     */
    protected $chapters;

    /**
     * @var CourseTagInterface[]
     */
    protected $courseTags;

    /**
     * @var CommentInterface[]
     */
    protected $comments;

    /**
     * @var string
     */
    protected $imagePath;

    /**
     * @var boolean
     */
    protected $active;

    /**
     * @var string
     */
    protected $hashTag;

    /**
     * @var string
     */
    protected $token;

    /**
     * @var integer
     */
    protected $view;

    /**
     * @var integer
     */
    protected $enroll;

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
        $this->published = false;
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
     * Set title
     *
     * @param string $title
     * @return self
     */
    public function setTitle($title)
    {
        $this->title = $title;
        return $this;
    }

    /**
     * Get title
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set author
     *
     * @param UserEntityInterface $author
     * @return self
     */
    public function setAuthor(UserEntityInterface $author)
    {
        $this->author = $author;
        return $this;
    }

    /**
     * Get author
     *
     * @return UserEntityInterface
     */
    public function getAuthor()
    {
        return $this->author;
    }

    /**
     * @return boolean
     */
    public function isPublished()
    {
        return $this->published;
    }

    /**
     * @param boolean $published
     * @return self
     */
    public function setPublished($published)
    {
        $this->published = $published;
        return $this;
    }

    /**
     * @return string
     */
    public function getVideoEmbedded()
    {
        return $this->videoEmbedded;
    }

    /**
     * @param string $videoEmbedded
     */
    public function setVideoEmbedded($videoEmbedded)
    {
        $this->videoEmbedded = $videoEmbedded;
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
     * Set view
     *
     * @param integer $view
     * @return self
     */
    public function setView($view)
    {
        $this->view = $view;
        return $this;
    }

    /**
     * Get view
     *
     * @return integer
     */
    public function getView()
    {
        return $this->view;
    }

    /**
     * Set enroll
     *
     * @param integer $enroll
     * @return self
     */
    public function setEnroll($enroll)
    {
        $this->enroll = $enroll;
        return $this;
    }

    /**
     * Get enroll
     *
     * @return integer
     */
    public function getEnroll()
    {
        return $this->enroll;
    }

    /**
     * @return ChapterInterface[]
     */
    public function getChapters()
    {
        if ($this->chapters === null) {
            $this->chapters = new ArrayCollection();
        }
        return $this->chapters;
    }

    /**
     * @param ChapterInterface[] $chapters
     * @return self
     */
    public function setChapters($chapters)
    {
        $this->chapters = $chapters;
        return $this;
    }

    /**
     * @return string
     */
    public function getIntroduce()
    {
        return $this->introduce;
    }

    /**
     * @param string $introduce
     * @return self
     */
    public function setIntroduce($introduce)
    {
        $this->introduce = $introduce;
        return $this;
    }


    /**
     * @return string
     */
    public function getImagePath()
    {
        return $this->imagePath;
    }

    /**
     * @param string $imagePath
     * @return self
     */
    public function setImagePath($imagePath)
    {
        $this->imagePath = $imagePath;
        return $this;
    }

    /**
     * @return string
     */
    public function getHashTag()
    {
        return $this->hashTag;
    }

    /**
     * @param string $hashTag
     * @return self
     */
    public function setHashTag($hashTag)
    {
        $this->hashTag = $hashTag;
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
     * Get deletedAt
     *
     * @return \DateTime
     */
    public function getDeletedAt()
    {
        return $this->deletedAt;
    }

    /**
     * @return ArrayCollection
     */
    public function getCourseTags()
    {
        if ($this->courseTags === null) {
            $this->courseTags = new ArrayCollection();
        }

        return $this->courseTags;
    }

    /**
     * @param $courseTags
     * @return self
     */
    public function setCourseTags($courseTags)
    {
        $this->courseTags = $courseTags;
        return $this;
    }

    /**
     * @return ArrayCollection
     */
    public function getComments()
    {
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
     * @return string
     */
    public function getToken()
    {
        return $this->token;
    }

    /**
     * @param string $token
     * @return self
     */
    public function setToken($token)
    {
        $this->token = $token;

        return $this;
    }

    /**
     * @return $this
     */
    public function increaseView()
    {
        $this->view++;
        return $this;
    }
}
