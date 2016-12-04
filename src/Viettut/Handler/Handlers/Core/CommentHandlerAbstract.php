<?php
/**
 * Created by PhpStorm.
 * User: giang
 * Date: 10/21/15
 * Time: 10:35 PM
 */

namespace Viettut\Handler\Handlers\Core;


use Viettut\DomainManager\CommentManagerInterface;
use Viettut\Handler\RoleHandlerAbstract;

abstract class CommentHandlerAbstract extends RoleHandlerAbstract
{
    /**
     * @inheritdoc
     *
     * Auto complete helper method
     *
     * @return CommentManagerInterface
     */
    protected function getDomainManager()
    {
        return parent::getDomainManager();
    }
}