<?php
/**
 * Created by PhpStorm.
 * User: giang
 * Date: 10/21/15
 * Time: 9:01 PM
 */

namespace Viettut\Repository\Core;
use Doctrine\Common\Persistence\ObjectRepository;
use Viettut\Model\User\UserEntityInterface;

interface TutorialRepositoryInterface extends ObjectRepository
{
    /**
     * @param UserEntityInterface $user
     * @param null $limit
     * @param null $offset
     * @return mixed
     */
    public function getTutorialByUser(UserEntityInterface $user, $limit = null, $offset = null);

    /**
     * @param UserEntityInterface $user
     * @param $hash
     * @return mixed
     */
    public function getByUserAndHash(UserEntityInterface $user, $hash);

    /**
     * @param $maxResult
     * @return mixed
     */
    public function getPopularTutorial($maxResult);

    /**
     * @return mixed
     */
    public function getAllTutorialQuery();

    /**
     * @param $tagName
     * @param null $limit
     * @param null $offset
     * @return mixed
     */
    public function getByTagName($tagName, $limit = null, $offset = null);

    /**
     * @param $keyword
     * @return mixed
     */
    public function search($keyword);
}