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

class TutorialTag implements TutorialTagInterface
{
    /**
     * @var integer
     */
    protected $id;

    /**
     * @var TutorialInterface
     */
    protected $tutorial;

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
