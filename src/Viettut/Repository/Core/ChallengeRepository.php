<?php
/**
 * Created by PhpStorm.
 * User: giang
 * Date: 10/21/15
 * Time: 9:01 PM
 */

namespace Viettut\Repository\Core;
use Doctrine\ORM\EntityRepository;
use Viettut\Model\User\UserEntityInterface;

class ChallengeRepository extends EntityRepository implements ChallengeRepositoryInterface
{
    public function getChallengeByUser(UserEntityInterface $user, $published = null, $limit = null, $offset = null)
    {
        $qb = $this->createQueryBuilder('c')
            ->where('c.author = :author')
            ->setParameter('author', $user);

        if (is_bool($published)) {
            $qb->andWhere('c.published = :published')
                ->setParameter('published', $published);
        }

        if (is_int($limit)) {
            $qb->setMaxResults($limit);
        }

        if (is_int($offset)) {
            $qb->setFirstResult($offset);
        }
        
        return $qb->getQuery()->getResult();
    }

    public function getAllChallengeQuery($published = null)
    {
        $qb = $this->createQueryBuilder('ch');

        if (is_bool($published)) {
            $qb->where('ch.published = :published')
                ->setParameter('published', $published);
        }

        return $qb->getQuery();
    }

    public function getChallengeByToken($token)
    {
        return $this->createQueryBuilder('ch')
            ->where('ch.token = :token')
            ->setParameter('token', $token)
            ->getQuery()
            ->getOneOrNullResult();
    }
}