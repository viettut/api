<?php
/**
 * Created by PhpStorm.
 * User: giang
 * Date: 8/31/17
 * Time: 10:04 PM
 */

namespace Viettut\Services;


use Viettut\Model\Core\TestInterface;
use Viettut\Model\Core\TestResultInterface;

interface RemoteServiceInterface
{
    /**
     * @return array
     */
    public function getLanguages();

    /**
     * @param $fileContent
     * @param null $uniqueId
     * @return mixed
     */
    public function putFile($fileContent, $uniqueId = null);

    /**
     * @param $sourceCode
     * @param TestInterface $test
     * @return mixed
     */
    public function runJob($sourceCode, TestInterface $test);

    /**
     * @param TestInterface $test
     * @param TestResultInterface $result
     * @return mixed
     */
    public function validateResult(TestInterface $test, TestResultInterface $result);
}