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
     * @var string
     */
    protected $sourceFileName;

    /**
     * @var string
     */
    protected $languageId;

    /**
     * @var array
     */
    protected $inputData;

    /**
     * @var string
     */
    protected $hashTag;

    /**
     * @var array
     */
    protected $serverParameters;

    /**
     * @var string
     */
    protected $name;

    /**
     * @var  array
     */
    protected $expectedResult;

    /**
     * @var TestCollectionInterface[]
     */
    protected $testCollection;

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

    /**
     * @return string
     */
    public function getSourceFileName()
    {
        return $this->sourceFileName;
    }

    /**
     * @param string $sourceFileName
     * @return self
     */
    public function setSourceFileName($sourceFileName)
    {
        $this->sourceFileName = $sourceFileName;
        return $this;
    }

    /**
     * @return string
     */
    public function getLanguageId()
    {
        return $this->languageId;
    }

    /**
     * @param string $languageId
     * @return self
     */
    public function setLanguageId($languageId)
    {
        $this->languageId = $languageId;
        return $this;
    }

    /**
     * @return array
     */
    public function getInputData()
    {
        return $this->inputData;
    }

    /**
     * @param array $inputData
     * @return self
     */
    public function setInputData($inputData)
    {
        $this->inputData = $inputData;
        return $this;
    }

    /**
     * @return array
     */
    public function getServerParameters()
    {
        return $this->serverParameters;
    }

    /**
     * @param array $serverParameters
     * @return self
     */
    public function setServerParameters($serverParameters)
    {
        $this->serverParameters = $serverParameters;
        return $this;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return self
     */
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return TestCollectionInterface
     */
    public function getTestCollection()
    {
        return $this->testCollection;
    }

    /**
     * @param TestCollectionInterface $testCollection
     */
    public function setTestCollection($testCollection)
    {
        $this->testCollection = $testCollection;
    }

    /**
     * @return string
     */
    public function getHashTag()
    {
        return $this->hashTag;
    }

    /**
     * @param string $hashTag
     * @return self
     */
    public function setHashTag($hashTag)
    {
        $this->hashTag = $hashTag;
        return $this;
    }
}