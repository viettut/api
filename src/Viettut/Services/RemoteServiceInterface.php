<?php
/**
 * Created by PhpStorm.
 * User: giang
 * Date: 8/31/17
 * Time: 10:04 PM
 */

namespace Viettut\Services;


use Viettut\Model\Core\TestInterface;

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
    public function putField($fileContent, $uniqueId = null);

    /**
     * @param $sourceCode
     * @param TestInterface $test
     * @return mixed
     */
    public function runJob($sourceCode, TestInterface $test);
}