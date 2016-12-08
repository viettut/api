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
use Viettut\Model\Core\CourseInterface;
use Viettut\Model\User\UserEntityInterface;

class ChapterRepository extends EntityRepository implements ChapterRepositoryInterface
{
    /**
     * @param UserEntityInterface $user
     * @param null $limit
     * @param null $offset
     * @return mixed
     */
    public function getChapterByUser(UserEntityInterface $user, $limit = null, $offset = null)
    {
        $qb = $this->createQueryBuilder('ch')
            ->where('ch.author = :author_id')
            ->setParameter('author_id', $user->getId(), TYPE::INTEGER);

        if (is_int($limit)) {
            $qb->setMaxResults($limit);
        }

        if (is_int($offset)) {
            $qb->setFirstResult($offset);
        }

        return $qb->getQuery()->getResult();
    }

    /**
     * @param CourseInterface $course
     * @param null $limit
     * @param null $offset
     * @return mixed
     */
    public function getChaptersByCourse(CourseInterface $course, $limit = null, $offset = null)
    {
        $qb = $this->createQueryBuilder('ch')
            ->where('ch.course = :course_id')
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
     * @param CourseInterface $course
     * @param $hash
     * @return mixed
     */
    public function getChapterByCourseAndHash(CourseInterface $course, $hash)
    {
        $qb = $this->createQueryBuilder('ch')
            ->where('ch.course = :course_id')
            ->andWhere('ch.hashTag = :hash')
            ->setParameter('hash', $hash, Type::STRING)
            ->setParameter('course_id', $course->getId(), TYPE::INTEGER);

        return $qb->getQuery()->getOneOrNullResult();
    }

    /**
     * @param CourseInterface $course
     * @param $position
     * @return mixed
     */
    public function getChapterByCourseAndPosition(CourseInterface $course, $position)
    {
        $qb = $this->createQueryBuilder('ch')
            ->where('ch.course = :course_id')
            ->andWhere('ch.position = :position')
            ->setParameter('position', $position, Type::INTEGER)
            ->setParameter('course_id', $course->getId(), TYPE::INTEGER);

        return $qb->getQuery()->getOneOrNullResult();
    }

    public function getByToken($token)
    {
        return $this->createQueryBuilder('ch')
            ->where('ch.token = :token')
            ->setParameter('token', $token)
            ->getQuery()
            ->getOneOrNullResult();
    }
}