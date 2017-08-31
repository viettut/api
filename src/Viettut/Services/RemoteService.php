<?php
/**
 * Created by PhpStorm.
 * User: giang
 * Date: 8/31/17
 * Time: 10:04 PM
 */

namespace Viettut\Services;


class RemoteService implements RemoteServiceInterface
{
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
     * @param string $languagesEndPoint
     * @param string $runJobsEndPoint
     * @param string $putFieldsEndPoint
     */
    public function __construct($languagesEndPoint, $runJobsEndPoint, $putFieldsEndPoint)
    {
        $this->languagesEndPoint = $languagesEndPoint;
        $this->runJobsEndPoint = $runJobsEndPoint;
        $this->putFieldsEndPoint = $putFieldsEndPoint;
    }


}