<?php
/**
 * Created by PhpStorm.
 * User: giang
 * Date: 10/21/15
 * Time: 9:07 PM
 */

namespace Viettut\Model\Core;


use Viettut\Model\ModelInterface;

interface TutorialTagInterface extends ModelInterface
{
    /**
     * @param $id
     * @return self
     */
    public function setId($id);

    /**
     * @return TutorialInterface
     */
    public function getTutorial();

    /**
     * @param TutorialInterface $tutorial
     * @return self
     */
    public function setTutorial($tutorial);

    /**
     * @return TagInterface
     */
    public function getTag();

    /**
     * @param TagInterface $tag
     * @return self
     */
    public function setTag($tag);

    /**
     * @return \DateTime
     */
    public function getCreatedAt();

    /**
     * Get deletedAt
     *
     * @return \DateTime
     */
    public function getDeletedAt();
}