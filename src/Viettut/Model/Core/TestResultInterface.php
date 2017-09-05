<?php


namespace Viettut\Model\Core;


interface TestResultInterface
{
    /**
     * @return string
     */
    public function getRunId();

    /**
     * @return int
     */
    public function getOutcome();

    /**
     * @return string
     */
    public function getCpmInfo();

    /**
     * @return string
     */
    public function getStdOut();

    /**
     * @return string
     */
    public function getStdErr();
}