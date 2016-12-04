<?php
/**
 * Created by PhpStorm.
 * User: giang
 * Date: 10/21/15
 * Time: 9:01 PM
 */

namespace Viettut\Repository\Core;
use Doctrine\DBAL\Types\Type;
use Doctrine\ORM\EntityRepository;
use Viettut\Model\Core\ChapterInterface;
use Viettut\Model\Core\CourseInterface;
use Viettut\Model\Core\TutorialInterface;

class CommentRepository extends EntityRepository implements CommentRepositoryInterface
{
    /**
     * @param CourseInterface $course
     * @param null $limit
     * @param null $offset
     * @return mixed
     */
    public function getByCourse(CourseInterface $course, $limit = null, $offset = null)
    {
        $qb = $this->createQueryBuilder('cm')
            ->where('cm.course = :course_id')
            ->setParameter('course_id', $course->getId(), TYPE::INTEGER);

        if (is_int($limit)) {
            $qb->setMaxResults($limit);
        }

        if (is_int($offset)) {
            $qb->setFirstResult($offset);
        }

        return $qb->getQuery()->getResult();
    }

    /**
     * @param ChapterInterface $chapter
     * @param null $limit
     * @param null $offset
     * @return mixed
     */
    public function getByChapter(ChapterInterface $chapter, $limit = null, $offset = null)
    {
        $qb = $this->createQueryBuilder('cm')
            ->where('cm.chapter = :chapter_id')
            ->setParameter('chapter_id', $chapter->getId(), TYPE::INTEGER);

        if (is_int($limit)) {
            $qb->setMaxResults($limit);
        }

        if (is_int($offset)) {
            $qb->setFirstResult($offset);
        }

        return $qb->getQuery()->getResult();
    }

    /**
     * @param TutorialInterface $tutorial
     * @param null $limit
     * @param null $offset
     * @return mixed
     */
    public function getByTutorial(TutorialInterface $tutorial, $limit = null, $offset = null)
    {
        $qb = $this->createQueryBuilder('cm')
            ->where('cm.tutorial = :tutorial_id')
            ->setParameter('tutorial_id', $tutorial->getId(), TYPE::INTEGER);

        if (is_int($limit)) {
            $qb->setMaxResults($limit);
        }

        if (is_int($offset)) {
            $qb->setFirstResult($offset);
        }

        return $qb->getQuery()->getResult();
    }
}