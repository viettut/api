<?php
/**
 * Created by PhpStorm.
 * User: giang
 * Date: 10/21/15
 * Time: 9:01 PM
 */

namespace Viettut\Repository\Core;
use Doctrine\ORM\EntityRepository;
use Viettut\Model\Core\CourseInterface;
use Viettut\Model\User\UserEntityInterface;

class UserChapterRepository extends EntityRepository implements UserChapterRepositoryInterface
{
    public function getUserChapterByUserAndCourse(UserEntityInterface $user, CourseInterface $course)
    {
        return $this->createQueryBuilder('uch')
            ->where('uch.author = :user')
            ->andWhere('uch.course = :course')
            ->setParameter('user', $user)
            ->setParameter('course', $course)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
}