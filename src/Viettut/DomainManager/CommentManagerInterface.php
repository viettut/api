<?php
/**
 * Created by PhpStorm.
 * User: giang
 * Date: 10/21/15
 * Time: 10:07 PM
 */

namespace Viettut\DomainManager;


use Viettut\Model\Core\ChapterInterface;
use Viettut\Model\Core\CourseInterface;
use Viettut\Model\Core\TutorialInterface;

interface CommentManagerInterface extends ManagerInterface
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