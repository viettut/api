<?php
/**
 * Created by PhpStorm.
 * User: giang
 * Date: 10/21/15
 * Time: 9:01 PM
 */

namespace Viettut\Repository\Core;
use Doctrine\Common\Persistence\ObjectRepository;
use Viettut\Model\Core\ChapterInterface;
use Viettut\Model\Core\CourseInterface;
use Viettut\Model\Core\TutorialInterface;

interface CommentRepositoryInterface extends ObjectRepository
{
    /**
     * @param CourseInterface $course
     * @param null $limit
     * @param null $offset
     * @return mixed
     */
    public function getByCourse(CourseInterface $course, $limit = null, $offset = null);

    /**
     * @param ChapterInterface $chapter
     * @param null $limit
     * @param null $offset
     * @return mixed
     */
    public function getByChapter(ChapterInterface $chapter, $limit = null, $offset = null);

    /**
     * @param TutorialInterface $tutorial
     * @param null $limit
     * @param null $offset
     * @return mixed
     */
    public function getByTutorial(TutorialInterface $tutorial, $limit = null, $offset = null);
}