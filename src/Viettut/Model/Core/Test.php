<?php
/**
 * Created by PhpStorm.
 * User: giang
 * Date: 8/31/17
 * Time: 10:13 PM
 */

namespace Viettut\Model\Core;


use Viettut\Model\User\UserEntityInterface;

class Test implements TestInterface
{
    /**
     * @var int
     */
    protected $id;

    /**
     * @var int
     */
    protected $type;

    /**
     * @var UserEntityInterface
     */
    protected $author;

    /**
     * @var string
     */
    protected $description;

    /**
     * @var array
     */
    protected $options;

    /**
     * @var string
     */
    protected $initialCode;

    /**
     * @var array
     */
    protected $fileList;

    /**
     * @var  array
     */
    protected $expectedResult;

    /**
     * Test constructor.
     */
    public function __construct()
    {
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return int
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param int $type
     */
    public function setType($type)
    {
        $this->type = $type;
    }

    /**
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param string $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     * @return array
     */
    public function getOptions()
    {
        return $this->options;
    }

    /**
     * @param array $options
     */
    public function setOptions($options)
    {
        $this->options = $options;
    }

    /**
     * @return string
     */
    public function getInitialCode()
    {
        return $this->initialCode;
    }

    /**
     * @param string $initialCode
     */
    public function setInitialCode($initialCode)
    {
        $this->initialCode = $initialCode;
    }

    /**
     * @return array
     */
    public function getFileList()
    {
        return $this->fileList;
    }

    /**
     * @param array $fileList
     */
    public function setFileList($fileList)
    {
        $this->fileList = $fileList;
    }

    /**
     * @return array
     */
    public function getExpectedResult()
    {
        return $this->expectedResult;
    }

    /**
     * @param array $expectedResult
     */
    public function setExpectedResult($expectedResult)
    {
        $this->expectedResult = $expectedResult;
    }

    /**
     * @return UserEntityInterface
     */
    public function getAuthor()
    {
        return $this->author;
    }

    /**
     * @param UserEntityInterface $author
     */
    public function setAuthor($author)
    {
        $this->author = $author;
    }
}