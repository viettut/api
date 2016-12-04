<?php
/**
 * Created by PhpStorm.
 * User: giang
 * Date: 10/21/15
 * Time: 9:07 PM
 */

namespace Viettut\Model\Core;


use Viettut\Model\ModelInterface;

interface TagInterface extends ModelInterface
{
    /**
     * @param $id
     * @return self
     */
    public function setId($id);


    /**
     * @return string
     */
    public function getText();

    /**
     * @param string $text
     * @return self
     */
    public function setText($text);

    /**
     * @return string
     */
    public function getIcon();

    /**
     * @param string $icon
     * @return self
     */
    public function setIcon($icon);

    /**
     * @return int
     */
    public function getCount();

    /**
     * @param int $count
     * @return self
     */
    public function setCount($count);

    /**
     * @return \DateTime
     */
    public function getCreatedAt();

    /**
     * @return \DateTime
     */
    public function getDeletedAt();
}