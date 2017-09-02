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

class TestRepository extends EntityRepository implements TestRepositoryInterface
{
    public function getTestForUser(UserEntityInterface $user, $limit = null, $offset = null)
    {
        $qb =  $this->createQueryBuilder('t')
            ->where('t.author = :author')
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