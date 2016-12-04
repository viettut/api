<?php
/**
 * Created by PhpStorm.
 * User: giang
 * Date: 10/21/15
 * Time: 9:07 PM
 */

namespace Viettut\Model\Core;


use Viettut\Model\ModelInterface;

interface SubscriberInterface extends ModelInterface
{
    /**
     * @param int $id
     * @return self
     */
    public function setId($id);

    /**
     * @return string
     */
    public function getEmail();

    /**
     * @param string $email
     * @return self
     */
    public function setEmail($email);

    /**
     * @return \DateTime
     */
    public function getCreatedAt();

    /**
     * @return \Datetime
     */
    public function getDeletedAt();
}