<?php
/**
 * Created by PhpStorm.
 * User: giang
 * Date: 26/02/2016
 * Time: 21:02
 */

namespace Viettut\Repository\Core;
use Doctrine\DBAL\Types\Type;
use Doctrine\ORM\EntityRepository;

class SubscriberRepository extends EntityRepository implements SubscriberRepositoryInterface
{
    /**
     * @param $email
     * @return mixed
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function getByEmail($email)
    {
        $qb = $this->createQueryBuilder('s')
            ->where('s.email = :email')
            ->setParameter('email', $email, Type::STRING)
        ;

        return $qb->getQuery()->getOneOrNullResult();
    }
}