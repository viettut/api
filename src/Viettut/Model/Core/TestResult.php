<?php


namespace Viettut\Model\Core;


class TestResult implements TestResultInterface
{
    const RUN_ID_KEY = 'run_id';
    const OUTCOME_KEY = 'outcome';
    const COMPILER_INFO_KEY = 'cmpinfo';
    const STD_OUT_KEY = 'stdout';
    const STD_ERR_KEY = 'stderr';


    /**
     * @var string
     */
    protected $runId;

    /**
     * @var int
     */
    protected $outcome;

    /**
     * @var string
     */
    protected $cpmInfo;

    /**
     * @var string
     */
    protected $stdOut;

    /**
     * @var string
     */
    protected $stdErr;

    /**
     * TestResult constructor.
     * @param $data
     */
    public function __construct($data)
    {
        if (array_key_exists(self::RUN_ID_KEY, $data)) {
            $this->runId = $data[self::RUN_ID_KEY];
        }

        if (array_key_exists(self::OUTCOME_KEY, $data)) {
            $this->outcome = $data[self::OUTCOME_KEY];
        }

        if (array_key_exists(self::COMPILER_INFO_KEY, $data)) {
            $this->cpmInfo = $data[self::COMPILER_INFO_KEY];
        }

        if (array_key_exists(self::STD_OUT_KEY, $data)) {
            $this->stdOut = $data[self::STD_OUT_KEY];
        }

        if (array_key_exists(self::STD_ERR_KEY, $data)) {
            $this->stdErr = $data[self::STD_ERR_KEY];
        }
    }


    /**
     * @return string
     */
    public function getRunId()
    {
        return $this->runId;
    }

    /**
     * @return int
     */
    public function getOutcome()
    {
        return $this->outcome;
    }

    /**
     * @return string
     */
    public function getCpmInfo()
    {
        return $this->cpmInfo;
    }

    /**
     * @return string
     */
    public function getStdOut()
    {
        return $this->stdOut;
    }

    /**
     * @return string
     */
    public function getStdErr()
    {
        return $this->stdErr;
    }
}