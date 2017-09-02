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
    public function getChallengeByUser(UserEntityInterface $user, $limit = null, $offset = null)
    {
        $qb = $this->createQueryBuilder('c')
            ->where('c.author = :author')
            ->setParameter('author', $user);
        
        if (is_int($limit)) {
            $qb->setMaxResults($limit);
        }

        if (is_int($offset)) {
            $qb->setFirstResult($offset);
        }
        
        return $qb->getQuery()->getResult();
    }

}