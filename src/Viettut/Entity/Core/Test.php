<?php
/**
 * Created by PhpStorm.
 * User: giang
 * Date: 8/31/17
 * Time: 10:19 PM
 */

namespace Viettut\Entity\Core;

use Viettut\Model\Core\Test as TestModel;

class Test extends TestModel
{
    protected $id;
    protected $type;
    protected $description;
    protected $options;
    protected $initialCode;
    protected $expectedResult;
    protected $fileList;
    protected $createdAt;
    protected $updatedAt;
}