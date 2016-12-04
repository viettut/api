<?php

namespace Viettut\Bundles\ApiBundle\Service;

use Viettut\Model\User\Role\LecturerInterface;
use Viettut\Model\User\UserEntityInterface;

class JWTResponseTransformer
{
    public function transform(array $data, UserEntityInterface $user)
    {
        $data['id'] = $user->getId();
        $data['username'] = $user->getUsername();
        $data['userRoles'] = $user->getUserRoles();
        $data['avatar'] = $user->getAvatar();
        if($user instanceof LecturerInterface) {
            $data['settings'] = $user->getSettings();
        }

        return $data;
    }
}