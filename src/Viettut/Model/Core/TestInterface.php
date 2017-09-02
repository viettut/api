<?php
/**
 * Created by PhpStorm.
 * User: giang
 * Date: 8/31/17
 * Time: 10:12 PM
 */

namespace Viettut\Model\Core;


use Viettut\Model\ModelInterface;
use Viettut\Model\User\UserEntityInterface;

interface TestInterface extends ModelInterface
{
    const TEST_TYPE_CHOICE = 1;
    const TEST_TYPE_CODE = 2;

    /**
     * @param int $id
     */
    public function setId($id);

    /**
     * @return int
     */
    public function getType();

    /**
     * @param int $type
     */
    public function setType($type);

    /**
     * @return string
     */
    public function getDescription();

    /**
     * @param string $description
     */
    public function setDescription($description);

    /**
     * @return array
     */
    public function getOptions();

    /**
     * @param array $options
     */
    public function setOptions($options);

    /**
     * @return string
     */
    public function getInitialCode();

    /**
     * @param string $initialCode
     */
    public function setInitialCode($initialCode);

    /**
     * @return array
     */
    public function getFileList();

    /**
     * @param array $fileList
     */
    public function setFileList($fileList);

    /**
     * @return array
     */
    public function getExpectedResult();

    /**
     * @param array $expectedResult
     */
    public function setExpectedResult($expectedResult);

    /**
     * @return UserEntityInterface
     */
    public function getAuthor();

    /**
     * @param UserEntityInterface $author
     */
    public function setAuthor($author);

    /**
     * @return TestCollectionInterface
     */
    public function getTestCollection();

    /**
     * @param TestCollectionInterface $testCollection
     */
    public function setTestCollection($testCollection);
}