<?php

namespace Esgi\UserBundle\Admin;

use Sonata\UserBundle\Admin\Entity\UserAdmin as BaseAdmin;

class UserAdmin extends BaseAdmin
{
    /**
     * {@inheritdoc}
     */
    protected $baseRoutePattern = 'users';
}
