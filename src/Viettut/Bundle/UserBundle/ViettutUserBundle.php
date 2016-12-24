<?php

namespace Viettut\Bundle\UserBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class ViettutUserBundle extends Bundle
{
    public function getParent()
    {
        return 'FOSUserBundle';
    }
}
