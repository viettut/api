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
use Doctrine\ORM\Query\ResultSetMapping;
use Viettut\Bundles\UserSystem\LecturerBundle\Entity\User;
use Viettut\Entity\Core\Course;
use Viettut\Model\Core\CourseInterface;
use Viettut\Model\User\Role\LecturerInterface;

class CourseRepository extends EntityRepository implements CourseRepositoryInterface
{
    /**
     * @param LecturerInterface $lecturer
     * @param null $limit
     * @param null $offset
     * @return mixed
     */
    public function getCourseByLecturer(LecturerInterface $lecturer, $limit = null, $offset = null)
    {
        $qb = $this->createQueryBuilder('c')
            ->where('c.author = :author_id')
            ->setParameter('author_id', $lecturer->getId(), TYPE::INTEGER);

        if (is_int($limit)) {
            $qb->setMaxResults($limit);
        }

        if (is_int($offset)) {
            $qb->setFirstResult($offset);
        }

        return $qb->getQuery()->getResult();
    }

    /**
     * @param $hashTag
     * @return null|CourseInterface
     */
    public function getCourseByHashTag($hashTag)
    {
        return $this->createQueryBuilder('c')
            ->where('c.hashTag = :hashTag')
            ->setParameter('hashTag', $hashTag, Type::STRING)
            ->getQuery()->getOneOrNullResult();
    }

    public function getByTagName($tagName, $limit = null, $offset = null)
    {
        $qb = $this->createQueryBuilder('c')
            ->leftJoin('c.courseTags', 'ct')
            ->leftJoin('ct.tag', 't')
            ->where('t.text = :tag_name')
            ->setParameter('tag_name', $tagName, Type::STRING)
        ;

        if (is_int($limit)) {
            $qb->setMaxResults($limit);
        }

        if (is_int($offset)) {
            $qb->setFirstResult($offset);
        }

        return $qb->getQuery()->getResult();
    }


    /**
     * @param $token
     * @return mixed
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function getCourseByToken($token)
    {
        return $this->createQueryBuilder('c')
            ->where('c.token = :token')
            ->setParameter('token', $token)
            ->getQuery()->getOneOrNullResult();
    }

    /**
     * @param $maxResult
     * @return array
     */
    public function getPopularCourse($maxResult)
    {
        $qb = $this->createQueryBuilder('c')
            ->addOrderBy('c.view', 'desc');

        if (is_int($maxResult)) {
            $qb->setMaxResults($maxResult);
        }
        else {
            $qb->setMaxResults(3);
        }
        return $qb->getQuery()->getResult();
    }

    /**
     * @param $maxResult
     * @return array
     */
    public function getRecentCourse($maxResult)
    {
        $qb = $this->createQueryBuilder('c')
            ->addOrderBy('c.createdAt', 'desc');

        if (is_int($maxResult)) {
            $qb->setMaxResults($maxResult);
        }
        else {
            $qb->setMaxResults(3);
        }
        return $qb->getQuery()->getResult();
    }

    /**
     * @param LecturerInterface $lecturer
     * @param $hashTag
     * @return mixed
     */
    public function getByLecturerAndHash(LecturerInterface $lecturer, $hashTag)
    {
        $qb = $this->createQueryBuilder('c')
            ->where('c.author = :author_id')
            ->andWhere('c.hashTag = :hashTag')
            ->setParameter('author_id', $lecturer->getId(), TYPE::INTEGER)
            ->setParameter('hashTag', $hashTag, Type::STRING)
        ;

        return $qb->getQuery()->getOneOrNullResult();
    }

    /**
     * @return mixed
     */
    public function getAllCourseQuery()
    {
        return $this->createQueryBuilder('c')->getQuery();
    }

    public function search($keyword)
    {
        $rsm = new ResultSetMapping();
        $rsm->addScalarResult('id', 'id')
            ->addScalarResult('title', 'title')
            ->addScalarResult('introduce', 'introduce')
            ->addScalarResult('active', 'active')
            ->addScalarResult('hash_tag', 'hashTag')
            ->addScalarResult('view', 'view')
            ->addScalarResult('token', 'token')
            ->addScalarResult('enroll', 'enroll')
            ->addScalarResult('image_path', 'imagePath')
            ->addScalarResult('created_at', 'createdAt')
            ->addScalarResult('updated_at', 'updatedAt')
            ->addScalarResult('deleted_at', 'deletedAt')
            ->addScalarResult('author_id', 'author')
        ;

        $sql = "SELECT * FROM viettut_course
                WHERE MATCH (title) AGAINST (:keyword IN NATURAL LANGUAGE MODE);
                ";

        $query = $this->_em->createNativeQuery($sql, $rsm)->setParameter('keyword', $keyword, Type::STRING);
        $results = $query->execute();
        $courses = [];

        $lecturerManager = $this->_em->getRepository(User::class);
        foreach($results as $result) {
            $course = new Course();
            $course->setId($result['id']);
            $course->setActive(filter_var($result['active'], FILTER_VALIDATE_BOOLEAN));
            $course->setToken($result['token']);
            $course->setEnroll(filter_var($result['enroll'], FILTER_VALIDATE_INT));
            $course->setImagePath($result['imagePath']);
            $course->setHashTag($result['hashTag']);
            $course->setIntroduce($result['introduce']);
            $course->setTitle($result['title']);
            $course->setIntroduce($result['introduce']);
            $course->setView(filter_var($result['view'], FILTER_VALIDATE_INT));

            $author = $lecturerManager->find($result['author']);
            $course->setAuthor($author);

            $courses[] = $course;
        }

        return $courses;
    }
}