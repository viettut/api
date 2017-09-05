<?php
/**
 * Created by PhpStorm.
 * User: giang
 * Date: 8/31/17
 * Time: 10:04 PM
 */

namespace Viettut\Services;


use RestClient\CurlRestClient;
use Viettut\Exception\RuntimeException;
use Viettut\Model\Core\TestInterface;
use Viettut\Model\Core\TestResult;
use Viettut\Model\Core\TestResultInterface;

class RemoteService implements RemoteServiceInterface
{
    const FILE_CONTENT_KEY = 'file_contents';
    const LANGUAGE_ID_KEY = 'language_id';
    const SOURCE_CODE_KEY = 'sourcecode';
    const FILE_LIST_KEY = 'file_list';
    const SOURCE_FILENAME_KEY = 'sourcefilename';
    const INPUT_KEY = 'input';
    const SERVER_PARAMETERS_KEY = 'parameters';


    /**
     * @var string
     */
    protected $jobeDomain;

    /**
     * @var string
     */
    protected $languagesEndPoint;

    /**
     * @var string
     */
    protected $runJobsEndPoint;

    /**
     * @var string
     */
    protected $putFieldsEndPoint;

    /**
     * RemoteService constructor.
     * @param $jobeDomain
     * @param string $languagesEndPoint
     * @param string $runJobsEndPoint
     * @param string $putFieldsEndPoint
     */
    public function __construct($jobeDomain, $languagesEndPoint, $runJobsEndPoint, $putFieldsEndPoint)
    {
        $this->jobeDomain = $jobeDomain;
        $this->languagesEndPoint = $languagesEndPoint;
        $this->runJobsEndPoint = $runJobsEndPoint;
        $this->putFieldsEndPoint = $putFieldsEndPoint;
    }

    public function getLanguages()
    {
        $curl = new CurlRestClient($this->jobeDomain);
        $data = $curl->get($this->languagesEndPoint);
        $curl->close();
        return $data;
    }

    public function putFile($fileContent, $uniqueId = null)
    {
        if ($uniqueId === null) {
            $uniqueId = md5(uniqid('', true));
        }

        $curl = new CurlRestClient($this->jobeDomain);
        $data = $curl->put(sprintf('%s/%s', $this->putFieldsEndPoint, $uniqueId), array (
            self::FILE_CONTENT_KEY => $fileContent
        ));

        $curl->close();
        return $data;
    }

    public function runJob($sourceCode, TestInterface $test)
    {
        if ($test->getType() != TestInterface::TEST_TYPE_CODE) {
            throw new RuntimeException('Expect an exercise test');
        }

        $curl = new CurlRestClient($this->jobeDomain);
        $params = array(self::SOURCE_CODE_KEY => $sourceCode, self::LANGUAGE_ID_KEY => $test->getLanguageId());

        if (!empty($test->getFileList())) {
            $params[self::FILE_LIST_KEY] = $test->getFileList();
        }

        if (!empty($test->getSourceFileName())) {
            $params[self::SOURCE_FILENAME_KEY] = $test->getSourceFileName();
        }

        if (!empty($test->getInputData())) {
            $params[self::INPUT_KEY] = $test->getInputData();
        }

        if (!empty($test->getServerParameters())) {
            $params[self::SERVER_PARAMETERS_KEY] = $test->getServerParameters();
        }

        $data = $curl->post($this->runJobsEndPoint, $params);
        $curl->close();

        return new TestResult($data);
    }

    public function validateResult(TestInterface $test, TestResultInterface $result)
    {
        if ($test->getType() == TestInterface::TEST_TYPE_CHOICE) {
            return $result->getOutcome() == $test->getExpectedResult()[TestResult::OUTCOME_KEY];
        }

        if ($result->getOutcome() == $test->getExpectedResult()[TestResult::OUTCOME_KEY] &&
            $result->getStdOut() == $test->getExpectedResult()[TestResult::STD_OUT_KEY] &&
            $result->getStdErr() == $test->getExpectedResult()[TestResult::STD_ERR_KEY]
        ) {
            return true;
        }

        return false;
    }
}