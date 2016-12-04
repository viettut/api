<?php
/**
 * Created by PhpStorm.
 * User: giang
 * Date: 26/02/2016
 * Time: 20:55
 */

namespace Viettut\Model\Core;


class Subscriber implements SubscriberInterface
{
    /**
     * @var integer
     */
    protected $id;
    /**
     * @var string
     */
    protected $email;

    /**
     * @var \DateTime
     */
    protected $createdAt;

    /**
     * @var \Datetime
     */
    protected $deletedAt;

    /**
     * Subscriber constructor.
     */
    public function __construct()
    {
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     * @return self
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param string $email
     * @return self
     */
    public function setEmail($email)
    {
        $this->email = $email;

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
     * @return \Datetime
     */
    public function getDeletedAt()
    {
        return $this->deletedAt;
    }
}