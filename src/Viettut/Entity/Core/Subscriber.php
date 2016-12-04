<?php
/**
 * Created by PhpStorm.
 * User: giang
 * Date: 26/02/2016
 * Time: 20:58
 */

namespace Viettut\Entity\Core;
use Viettut\Model\Core\Subscriber as SubscriberModel;

class Subscriber extends SubscriberModel
{
    protected $id;
    protected $email;
    protected $createdAt;
    protected $deletedAt;
}