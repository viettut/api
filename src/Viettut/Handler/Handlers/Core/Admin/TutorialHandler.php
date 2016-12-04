<?php
/**
 * Created by PhpStorm.
 * User: giang
 * Date: 10/21/15
 * Time: 10:47 PM
 */

namespace Viettut\Handler\Handlers\Core\Admin;


use Viettut\Handler\Handlers\Core\TutorialHandlerAbstract;
use Viettut\Model\User\Role\AdminInterface;
use Viettut\Model\User\Role\UserRoleInterface;

class TutorialHandler extends TutorialHandlerAbstract{

    /**
     * @param UserRoleInterface $role
     * @return bool
     */
    public function supportsRole(UserRoleInterface $role)
    {
        return $role instanceof AdminInterface;
    }
}