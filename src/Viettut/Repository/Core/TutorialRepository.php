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
use Viettut\Bundle\UserBundle\Entity\User;
use Viettut\Entity\Core\Tutorial;
use Viettut\Model\User\UserEntityInterface;

class TutorialRepository extends EntityRepository implements TutorialRepositoryInterface
{
    /**
     * @param UserEntityInterface $user
     * @param null $limit
     * @param null $offset
     * @return mixed
     */
    public function getTutorialByUser(UserEntityInterface $user, $limit = null, $offset = null)
    {
        $qb = $this->createQueryBuilder('t')
            ->where('t.author = :author_id')
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
     * @param UserEntityInterface $user
     * @param $hash
     * @return mixed
     */
    public function getByUserAndHash(UserEntityInterface $user, $hash)
    {
        $qb = $this->createQueryBuilder('t')
            ->where('t.author = :author_id')
            ->andWhere('t.hashTag = :hash')
            ->setParameter('hash', $hash, TYPE::STRING)
            ->setParameter('author_id', $user->getId(), TYPE::INTEGER);

        return $qb->getQuery()->getOneOrNullResult();
    }

    /**
     * @param $maxResult
     * @return array
     */
    public function getPopularTutorial($maxResult)
    {
        $qb = $this->createQueryBuilder('t')
            ->addOrderBy('t.view', 'desc');

        if (is_int($maxResult)) {
            $qb->setMaxResults($maxResult);
        }
        else {
            $qb->setMaxResults(3);
        }
        return $qb->getQuery()->getResult();
    }

    /**
     * @return mixed
     */
    public function getAllTutorialQuery()
    {
        return $this->createQueryBuilder('t')->getQuery();
    }

    public function getByTagName($tagName, $limit = null, $offset = null)
    {
        $qb = $this->createQueryBuilder('tu')
            ->leftJoin('tu.tutorialTags', 'tt')
            ->leftJoin('tt.tag', 't')
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

    public function search($keyword)
    {
        $rsm = new ResultSetMapping();
        $rsm->addScalarResult('id', 'id')
            ->addScalarResult('title', 'title')
            ->addScalarResult('content', 'content')
            ->addScalarResult('active', 'active')
            ->addScalarResult('hash_tag', 'hashTag')
            ->addScalarResult('view', 'view')
            ->addScalarResult('likes', 'likes')
            ->addScalarResult('created_at', 'createdAt')
            ->addScalarResult('updated_at', 'updatedAt')
            ->addScalarResult('deleted_at', 'deletedAt')
            ->addScalarResult('author_id', 'author')
        ;

        $sql = "SELECT * FROM viettut_tutorial
                WHERE MATCH (title) AGAINST (:keyword IN NATURAL LANGUAGE MODE);
                ";

        $query = $this->_em->createNativeQuery($sql, $rsm);
        $query->setParameter('keyword', $keyword);
        $results = $query->execute();
        $tutorials = [];

        $lecturerManager = $this->_em->getRepository(User::class);
        foreach($results as $result) {
            $tutorial = new Tutorial();
            $tutorial
                ->setId($result['id'])
                ->setView(filter_var($result['view'], FILTER_VALIDATE_INT))
                ->setTitle($result['title'])
                ->setHashTag($result['hashTag'])
                ->setActive(filter_var($result['active'], FILTER_VALIDATE_BOOLEAN))
                ->setContent($result['content'])
                ->setLikes(filter_var($result['likes'], FILTER_VALIDATE_INT))
            ;

            $author = $lecturerManager->find($result['author']);
            $tutorial->setAuthor($author);

            $tutorials[] = $tutorial;
        }

        return $tutorials;
    }
}