<?php
/**
 * Created by PhpStorm.
 * User: giang
 * Date: 10/21/15
 * Time: 10:35 PM
 */

namespace Viettut\Handler\Handlers\Core;


use Viettut\DomainManager\ChapterManagerInterface;
use Viettut\DomainManager\TutorialManagerInterface;
use Viettut\Handler\RoleHandlerAbstract;

abstract class TutorialHandlerAbstract extends RoleHandlerAbstract
{
    /**
     * @inheritdoc
     *
     * Auto complete helper method
     *
     * @return TutorialManagerInterface
     */
    protected function getDomainManager()
    {
        return parent::getDomainManager();
    }
}