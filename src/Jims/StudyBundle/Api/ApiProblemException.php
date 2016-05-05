<?php
/**
 * Created by PhpStorm.
 * User: jimspete
 * Date: 2016/5/8
 * Time: 13:48
 */

namespace Jims\StudyBundle\Api;


use Symfony\Component\HttpKernel\Exception\HttpException;
#use Jims\StudyBundle\Api\ApiProblem;

class ApiProblemException extends HttpException
{
  /**
   * @var ApiProblem
   */
  private $apiProblem;

  public function __construct(ApiProblem $apiProblem, \Exception $previous=null, array $headers=array(), $code=0)
  {
    $this->apiProblem = $apiProblem;
    $statusCode = $apiProblem->getStatusCode();
    $message = $apiProblem->getTitle();


    parent::__construct($statusCode, $message, $previous, $headers, $code);

  }

  /**
   * @return ApiProblem
   */
  public function getApiProblem()
  {
    return $this->apiProblem;
  }


}