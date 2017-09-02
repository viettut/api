<?php
/**
 * Created by PhpStorm.
 * User: giang
 * Date: 10/21/15
 * Time: 10:48 PM
 */

namespace Viettut\Handler\Handlers\Core;


use Viettut\DomainManager\TestManagerInterface;
use Viettut\Handler\RoleHandlerAbstract;
use Viettut\Model\Core\TestInterface;
use Viettut\Model\ModelInterface;
use Viettut\Model\User\UserEntityInterface;

class TestHandler extends RoleHandlerAbstract
{

    /**
     * @param UserEntityInterface $role
     * @return bool
     */
    public function supportsRole(UserEntityInterface $role)
    {
        return true;
    }

    /**
     * @inheritdoc
     */
    public function all($limit = null, $offset = null)
    {
        /** @var UserEntityInterface $lecturer */
        $lecturer = $this->getUserRole();
        return $this->getDomainManager()->getTestForUser($lecturer, $limit, $offset);
    }

    protected function processForm(ModelInterface $entity, array $parameters, $method = 'PUT')
    {
        /** @var TestInterface $entity */
        if (null === $entity->getAuthor()) {
            $entity->setAuthor($this->getUserRole());
        }

        return parent::processForm($entity, $parameters, $method);
    }

    /**
     * @inheritdoc
     *
     * Auto complete helper method
     *
     * @return TestManagerInterface
     */
    protected function getDomainManager()
    {
        return parent::getDomainManager();
    }
}