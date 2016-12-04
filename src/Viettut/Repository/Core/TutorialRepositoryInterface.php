<?php
/**
 * Created by PhpStorm.
 * User: giang
 * Date: 10/21/15
 * Time: 9:01 PM
 */

namespace Viettut\Repository\Core;
use Doctrine\Common\Persistence\ObjectRepository;
use Viettut\Model\User\Role\LecturerInterface;

interface TutorialRepositoryInterface extends ObjectRepository
{
    /**
     * @param LecturerInterface $lecturer
     * @param null $limit
     * @param null $offset
     * @return mixed
     */
    public function getTutorialByLecturer(LecturerInterface $lecturer, $limit = null, $offset = null);

    /**
     * @param LecturerInterface $lecturer
     * @param $hash
     * @return mixed
     */
    public function getByLecturerAndHash(LecturerInterface $lecturer, $hash);

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