<?php
/**
 * Created by PhpStorm.
 * User: giang
 * Date: 10/21/15
 * Time: 10:48 PM
 */

namespace Viettut\Handler\Handlers\Core;


use Viettut\DomainManager\TestCollectionManagerInterface;
use Viettut\Handler\RoleHandlerAbstract;
use Viettut\Model\User\UserEntityInterface;

class TestCollectionHandler extends RoleHandlerAbstract
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
        return $this->getDomainManager()->all($limit, $offset);
    }

    /**
     * @inheritdoc
     *
     * Auto complete helper method
     *
     * @return TestCollectionManagerInterface
     */
    protected function getDomainManager()
    {
        return parent::getDomainManager();
    }
}