<?php
/**
 * Created by PhpStorm.
 * User: giang
 * Date: 10/21/15
 * Time: 10:35 PM
 */

namespace Viettut\Handler\Handlers\Core;


use Viettut\DomainManager\ChapterManagerInterface;
use Viettut\Handler\RoleHandlerAbstract;

abstract class ChapterHandlerAbstract extends RoleHandlerAbstract
{
    /**
     * @inheritdoc
     *
     * Auto complete helper method
     *
     * @return ChapterManagerInterface
     */
    protected function getDomainManager()
    {
        return parent::getDomainManager();
    }
}